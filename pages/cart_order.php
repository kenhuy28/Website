<?php include '../templates/header.php' ?>
<?php
// Kiểm tra giỏ hàng
if (!isset($_SESSION['gioHang']) || $_SESSION['gioHang'] == 0) {
    echo "<script>
    alert('Giỏ hàng trống, vui lòng chọn sản phẩm!!');
    window.location.href = '$rootPath/pages/product_page.php';
    </script>";
    exit();
}
// Lấy thông tin khách hàng từ session
$maKhachHang = $_SESSION['taiKhoan']['maKhachHang'];
$maXa = $_SESSION['taiKhoan']['maXa'];
// Truy vấn lấy thông tin giỏ hàng
$statement = $dbh->prepare(
    "SELECT 
        gio_hang.soLuong, 
        san_pham.maSanPham, 
        san_pham.tenSanPham, 
        san_pham.donGiaBan, 
        san_pham.hinhAnh, 
        thuong_hieu.tenThuongHieu, 
        IFNULL(giam_gia.maLoai, 0) AS maLoai, 
        IFNULL(
            CASE 
                WHEN giam_gia.ngayBatDau <= CURDATE() AND giam_gia.ngayKetThuc >= CURDATE() THEN giam_gia.giaTriGiam 
                ELSE 0 
            END, 
            0
        ) AS giaTriGiam 
    FROM gio_hang 
    JOIN san_pham ON gio_hang.maSanPham = san_pham.maSanPham 
    JOIN thuong_hieu ON thuong_hieu.maThuongHieu = san_pham.maThuongHieu 
    LEFT JOIN giam_gia ON san_pham.maSanPham = giam_gia.maSanPham 
    WHERE gio_hang.maKhachHang = :maKhachHang"
);
$statement->bindParam(':maKhachHang', $maKhachHang, PDO::PARAM_STR);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
// Truy vấn lấy thông tin địa chỉ
$get_dia_chi = $dbh->prepare(
    "SELECT xa.tenXa, huyen.tenHuyen, tinh.tenTinh, tinh.maTinh 
    FROM xa 
    JOIN huyen ON xa.maHuyen = huyen.maHuyen 
    JOIN tinh ON huyen.maTinh = tinh.maTinh 
    WHERE xa.maXa = :maXa"
);
$get_dia_chi->bindParam(':maXa', $maXa, PDO::PARAM_STR);
$get_dia_chi->execute();
$diachi = $get_dia_chi->fetch(PDO::FETCH_OBJ);

if (!$diachi) {
    echo "<script>
    alert('Không tìm thấy địa chỉ khách hàng!');
    window.location.href = '$rootPath/pages/profile.php';
    </script>";
    exit();
}
$maTinh = $diachi->maTinh;
// Truy vấn lấy thông tin phí vận chuyển và thời gian giao dự kiến
$get_shipping = $dbh->prepare(
    "SELECT phiVanChuyen, thoiGianGiao 
     FROM shipping_fee 
     WHERE maTinh = :maTinh"
);
$get_shipping->bindParam(':maTinh', $maTinh, PDO::PARAM_STR);
$get_shipping->execute();
$shipping = $get_shipping->fetch(PDO::FETCH_ASSOC);

if ($shipping) {
    $phiVanChuyen = $shipping['phiVanChuyen'];
    $thoiGianGiao = $shipping['thoiGianGiao'];
} else {
    // Mặc định nếu không tìm thấy thông tin shipping_fee
    $phiVanChuyen = 50000; // Ví dụ
    $thoiGianGiao = '3-7 ngày';
}
// Khởi tạo tổng tiền
$tongTienBanDau = 0;
// Mảng để lưu chi tiết đơn hàng
$orderDetails = [];
// Tính tổng tiền trước khi áp dụng giảm giá và phí vận chuyển
while ($row = $statement->fetch()) {
    // Tính thành tiền cho từng sản phẩm
    if ($row->maLoai == 1) {
        // Giảm giá cố định
        $donGia = $row->donGiaBan - $row->giaTriGiam;
    } elseif ($row->maLoai == 2) {
        // Giảm giá theo phần trăm
        $donGia = $row->donGiaBan - ($row->donGiaBan * $row->giaTriGiam / 100);
    } else {
        $donGia = $row->donGiaBan;
    }
    $thanhTien = $donGia * $row->soLuong;
    $tongTienBanDau += $thanhTien;
    // Thêm chi tiết vào mảng
    $orderDetails[] = [
        'maSanPham' => $row->maSanPham,
        'tenSanPham' => $row->tenSanPham,
        'soLuong' => $row->soLuong,
        'donGia' => $donGia,
        'thanhTien' => $thanhTien
    ];
}
// Lấy điểm tích lũy hiện tại
$checkPoints = $dbh->prepare("SELECT tongDiem FROM diem_tich_luy WHERE maKhachHang = :maKhachHang");
$checkPoints->bindParam(':maKhachHang', $maKhachHang, PDO::PARAM_STR);
$checkPoints->execute();
$currentPoints = $checkPoints->fetchColumn();

$capBac = '';
if ($currentPoints !== false) {
    if ($currentPoints >= 30) {
        $capBac = 'Vang';
    } elseif ($currentPoints >= 20) {
        $capBac = 'Bac';
    } elseif ($currentPoints >= 10) {
        $capBac = 'Dong';
    }
}

// Lấy mức giảm giá dựa trên cấp bậc
$discountRate = 0;
if ($capBac) {
    $discountQuery = $dbh->prepare("SELECT giamGia FROM cap_bac WHERE tenCapBac = :capBac");
    $discountQuery->bindParam(':capBac', $capBac, PDO::PARAM_STR);
    $discountQuery->execute();
    $discountRate = $discountQuery->fetchColumn();
}
// Tính tổng tiền sau giảm giá
$tongTienSauGiamGia = $tongTienBanDau;
if ($discountRate) {
    $tongTienSauGiamGia -= ($tongTienSauGiamGia * ($discountRate / 100));
}
// Tính tổng tiền cuối cùng bao gồm phí vận chuyển
$tongTienFinal = $tongTienSauGiamGia + $phiVanChuyen;

// Kiểm tra và tạo điểm tích lũy nếu chưa có
$checkIfExists = $dbh->prepare("SELECT COUNT(*) FROM diem_tich_luy WHERE maKhachHang = :maKhachHang");
$checkIfExists->bindParam(':maKhachHang', $maKhachHang, PDO::PARAM_STR);
$checkIfExists->execute();

if ($checkIfExists->fetchColumn() == 0) {
    // Nếu chưa có, tạo một bản ghi mới
    $insertNewRecord = $dbh->prepare("INSERT INTO diem_tich_luy (maKhachHang, tongDiem, capBac) VALUES (:maKhachHang, 0, 'Dong')");
    $insertNewRecord->bindParam(':maKhachHang', $maKhachHang, PDO::PARAM_STR);
    $insertNewRecord->execute();
}
// Cập nhật điểm tích lũy
$diemTichLuy = floor($tongTienBanDau / 1000000); // 1 điểm cho mỗi triệu VND
$updatePoints = $dbh->prepare("UPDATE diem_tich_luy SET tongDiem = tongDiem + :diemTichLuy WHERE maKhachHang = :maKhachHang");
$updatePoints->bindParam(':diemTichLuy', $diemTichLuy, PDO::PARAM_INT);
$updatePoints->bindParam(':maKhachHang', $maKhachHang, PDO::PARAM_STR);
$updatePoints->execute();
// Cập nhật cấp bậc nếu cần thiết
if ($capBac) {
    $updateRank = $dbh->prepare("UPDATE diem_tich_luy SET capBac = :capBac WHERE maKhachHang = :maKhachHang");
    $updateRank->bindParam(':capBac', $capBac, PDO::PARAM_STR);
    $updateRank->bindParam(':maKhachHang', $maKhachHang, PDO::PARAM_STR);
    $updateRank->execute();
}

?>
<div class="thanhToan">
    <div class="thanhToan_user">
        <form action="<?php echo htmlspecialchars($rootPath . '/includes/process_order.php', ENT_QUOTES, 'UTF-8'); ?>" method="post">
            <h1 class="Title_Admin_create_form">Thông tin đơn đặt hàng</h1>
            <p class="Notification_create_form">Vui lòng kiểm tra thông tin nhận hàng</p>
            <div style="display: flex;">
            <div class="form_field" style="margin-right: 20px;">
                <label for="fullname" class="name_form_field">Họ tên: </label>
                <input type="text" name="fullname" id="fullname" value="<?php echo htmlspecialchars($_SESSION['taiKhoan']['hoKhachHang'] . ' ' . $_SESSION['taiKhoan']['tenKhachHang'], ENT_QUOTES, 'UTF-8'); ?>"
                    class="textfile" style="width: 400px; border-radius: 10px;">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="phoneNumber" class="name_form_field">Số điện thoại: </label>
                <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo htmlspecialchars($_SESSION['taiKhoan']['dienThoai'], ENT_QUOTES, 'UTF-8'); ?>"
                    class="textfile" style="width: 180px; border-radius: 10px;">
                <span class="error_message"></span>
            </div>
            </div>

            <div class="form_field">
            <label for="email" class="name_form_field">Email: </label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['taiKhoan']['email'], ENT_QUOTES, 'UTF-8'); ?>"
                class="textfile" style="width: 600px; border-radius: 10px;">
            <span class="error_message"></span>
            </div>
            <div class="form_field">
            <label for="diaChi" class="name_form_field">Địa chỉ: </label>
            <input type="text" name="diaChi" id="diaChi" value="<?php echo htmlspecialchars($_SESSION['taiKhoan']['diaChiCuThe'] . ', ' . $diachi->tenXa . ', ' . $diachi->tenHuyen . ', ' . $diachi->tenTinh, ENT_QUOTES, 'UTF-8'); ?>"
                class="textfile" style="width: 600px; border-radius: 10px;">
            <span class="error_message"></span>
            </div>
            <button type="button" onclick="addRecipientInfo()">Thêm Thông Tin Người Nhận Mới</button>
            <!-- Trường thông tin người nhận mới (ẩn ban đầu) -->
            <div id="newRecipientInfo" style="display:none;">
            <div class="form_row">
                <div class="form_field" >
                    <label for="newName" >Họ Tên: <input type="text" name="newName" id="newName" /></label>
                </div>
                <div class="form_field">
                    <label for="newPhone">SĐT: <input type="text" name="newPhone" id="newPhone" /></label>
                </div>
            </div>
            <label for="newEmail">Email: <input type="text" name="newEmail" id="newEmail" /></label>
            <label for="newAddress">Địa Chỉ: <input type="text" name="newAddress" id="newAddress" /></label>
            </div>

            <!-- Hiển thị thông tin vận chuyển -->
            <div class="form_field">
                <label for="" class="name_form_field">Phí Vận Chuyển: </label>
                <input disabled type="text" value="<?php echo number_format($phiVanChuyen, 0, ',', '.') . ' VNĐ'; ?>" class="textfile"
                    id="phiVanChuyen" style="width: 600px; border-radius: 10px;">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Thời Gian Giao Dự Kiến: </label>
                <input disabled type="text" value="<?php echo htmlspecialchars($thoiGianGiao, ENT_QUOTES, 'UTF-8'); ?>" class="textfile"
                    id="thoiGianGiao" style="width: 600px; border-radius: 10px;">
                <span class="error_message"></span>
            </div>
            <div hidden>
                <input name="tongTien" type="text" value="<?php echo htmlspecialchars($tongTienBanDau, ENT_QUOTES, 'UTF-8'); ?>">
                <input name="maTinh" type="text" value="<?php echo htmlspecialchars($maTinh, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="button">
                <input type="submit" name="submit_order" value="Đặt hàng" class="button_add_admin" style="width: 200px;" />
                <button type="submit" name="redirect" class="button_add_admin" style="width: 200px;">Đặt hàng trực tuyến</button>
                <a href="./cart.php"> 
                    <input type="button" value="Quay trở lại giỏ hàng" class="button_add_admin" style="width: 200px;" />
                </a>
            </div>
        </form>
    </div>
    <div class="thanhToan_cart" style="width: 50%;">
        <h1 class="Title_Admin_create_form" style="font-size: 26px;">Thông tin chi tiết đơn hàng</h1>
        <div style="width: 100%; display: inline-flex;">
            <b style="width: 60%; padding-left: 20%;">Sản phẩm</b>
            <b style="width: 20%">Số lượng</b>
            <b style="width: 20%">Thành tiền</b>
        </div>
        <?php
        // Truy vấn lại giỏ hàng để hiển thị
        $statement->execute();
        while ($row = $statement->fetch()) {
            // Tính thành tiền cho từng sản phẩm
            if ($row->maLoai == 1) {
                // Giảm giá cố định
                $donGia = $row->donGiaBan - $row->giaTriGiam;
            } elseif ($row->maLoai == 2) {
                // Giảm giá theo phần trăm
                $donGia = $row->donGiaBan - ($row->donGiaBan * $row->giaTriGiam / 100);
            } else {
                $donGia = $row->donGiaBan;
            }
            $thanhTien = $donGia * $row->soLuong;

            echo '<div class="thanhToan_cart_list_item">
                    <div class="body_table_title body_table_title_sanpham" style="width: 60%;">
                        <img src="' . htmlspecialchars($rootPath . '/assets/img/sanpham/' . trim($row->hinhAnh), ENT_QUOTES, 'UTF-8') . '" alt="" style="width: 64px; height: 66px; margin-right: 20px;">
                        <div class="thanhToan_cart_list_item_title"  style="max-width: 350px;">
                            ' . htmlspecialchars($row->tenSanPham, ENT_QUOTES, 'UTF-8') . ' 
                        </div>
                    </div>
                    <div class="thanhToan_cart_list_item_soluong" style="min-width: 50px; margin-left: 10px; width: 20%;">
                        ' . intval($row->soLuong) . '
                    </div>
                    <div class="thanhToan_cart_list_item_gia" style="min-width: 100px; width: 20%;">' .
                number_format($thanhTien, 0, ',', '.') . ' VNĐ</div>
                </div>';
        }
        ?>
        <!-- Hiển thị tổng tiền -->
        <div class="thanhToan_summary">
    <div class="thanhToan_cart_tong"><b>Tổng tiền hàng: &nbsp;</b><?php echo number_format($tongTienBanDau, 0, ',', '.') . " VNĐ"; ?></div>
    <?php if ($discountRate) { ?>
        <div class="thanhToan_cart_tong"><b>Giảm giá (<?php echo intval($discountRate); ?>%): &nbsp;</b>-<?php echo number_format($tongTienBanDau * ($discountRate / 100), 0, ',', '.') . " VNĐ"; ?></div>
    <?php } ?>
    <div class="thanhToan_cart_tong tongTien_final"><b>Tổng tiền thanh toán: &nbsp;</b><?php echo number_format($tongTienFinal, 0, ',', '.') . " VNĐ"; ?></div>
    </div>
</div>

</div>
<script>
  function addRecipientInfo() {
    document.getElementById("newRecipientInfo").style.display = "block";
  }

  document.getElementById("orderForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const orderData = {
      userName: document.getElementById("userName").value,
      userPhone: document.getElementById("userPhone").value,
      userEmail: document.getElementById("userEmail").value,
      userAddress: document.getElementById("userAddress").value,
      newName: document.getElementById("newName").value,
      newPhone: document.getElementById("newPhone").value,
      newEmail: document.getElementById("newEmail").value,
      newAddress: document.getElementById("newAddress").value
    };

    // Gửi dữ liệu đến máy chủ
    const response = await fetch('/submitOrder', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(orderData)
    });

    const result = await response.json();
    if (result.success) alert('Đơn Hàng Đã Được Gửi Thành Công!');
    else alert('Lỗi: ' + result.message);
  });
</script>
<style>
    #newName {
    width: 400px !important;  /* Sử dụng !important để đảm bảo quy tắc này được áp dụng */
    height: 40px !important;
    padding: 5px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.thanhToan_summary {
    border: 1px solid #ddd;
    padding: 0; /* Đặt padding thành 0 */
    border-radius: 8px;
    background-color: #ffffff;
    max-width: 402px;
    margin: 20px auto;
    display: flex;
    flex-direction: column;
}

.thanhToan_cart_tong {
    width: 400px;
    height: 50px;
    padding: 4px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 17px;
    color: #444;
    display: flex;
    justify-content: space-between;
    background-color: #f8f9fa;
    transition: background-color 0.3s;
    margin-bottom: 10px; /* Giữ khoảng cách âm giữa các div */
    margin-top: 10px; /* Thêm margin âm để giảm khoảng cách trên */
}

.thanhToan_cart_tong:first-child {
    margin-top: 0; /* Bỏ margin trên cho div đầu tiên */
}

.thanhToan_cart_tong:hover {
    background-color: #e9ecef; /* Nền màu xám nhạt khi hover */
}

.tongTien_final {
    font-weight: bold;
    font-size: 18px; /* Kích thước chữ lớn hơn cho tổng tiền thanh toán */
    color: #d9534f; /* Màu đỏ cho tổng tiền thanh toán */
    padding-top: 10px; /* Khoảng cách trên */
    border-top: 2px solid #d9534f; /* Viền trên màu đỏ */
}
/* Định dạng chung cho form */
#newRecipientInfo {
    margin-top: 10px;
    padding: 10px;
    background-color: transparent; 
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: none; 
}

#newRecipientInfo label {
    display: block;
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

#newRecipientInfo input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
    box-sizing: border-box;
    background-color: transparent;
    transition: border-color 0.3s;
}

#newRecipientInfo input:focus {
    border-color: #007bff;
    outline: none;
}

/* Đặt button ở giữa và thay đổi màu thành đỏ */
button[type="button"] {
    background-color: #dc3545; /* Màu đỏ */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: block;
    margin: 20px auto; /* Trung tâm hóa button */
}

button[type="button"]:hover {
    background-color: #c82333; /* Màu đỏ đậm khi hover */
}

#newRecipientInfo .form-row {
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
}

#newRecipientInfo .form-field {
    width: 48%; /* Chiếm 48% chiều rộng mỗi trường */
}

/* Đặt button ở giữa và thay đổi màu thành đỏ */
button[type="button"] {
    background-color: #dc3545; /* Màu đỏ */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: block;
    margin: 20px auto; /* Trung tâm hóa button */
}

button[type="button"]:hover {
    background-color: #c82333; /* Màu đỏ đậm khi hover */
}

/* Flex container cho Họ Tên và SĐT */

.form_row {
    display: flex;
    gap: 30px; /* Khoảng cách giữa Họ Tên và SĐT */
}

/* Họ Tên chiếm 60% chiều rộng */
.form_field:nth-child(1) {
    flex: 7;
}

/* SĐT chiếm 40% chiều rộng */
.form_field:nth-child(2) {
    flex: 3;
}

.form_field {
    padding-bottom: 16px;
    min-height: 90px;
    width: 100%; /* Chiếm toàn bộ chiều rộng */
    display: flex; /* Sử dụng flexbox */
    flex-direction: column; /* Căn giữa theo chiều dọc */
    align-items: center; /* Căn giữa theo chiều ngang */
}

.form_field label {
    display: block; /* Chuyển label thành block để input sẽ nằm dưới */
    font-size: 14px;
    margin-bottom: 5px;
}

/* Đảm bảo form hiển thị đẹp trên các màn hình nhỏ */
@media (max-width: 768px) {
    .form_row {
        flex-direction: column; /* Các input sẽ xếp chồng lên nhau trên màn hình nhỏ */
    }
}
</style>
<?php include '../templates/footer.php' ?>