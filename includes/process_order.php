<?php
include("config.php"); // Kết nối tới cơ sở dữ liệu

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

/**
 * Hàm để gửi email xác nhận đơn hàng
 *
 * @param string $customerEmail Email của khách hàng
 * @param string $customerName Tên của khách hàng
 * @param string $maDonHang Mã đơn hàng
 * @param array $orderDetails Chi tiết đơn hàng
 * @param float $tongTienSauGiamGia Tổng tiền sau giảm giá và phí vận chuyển
 * @param float $phiVanChuyen Phí vận chuyển
 * @param string $thoiGianGiao Thời gian giao dự kiến
 * @return void
 */
function sendOrderConfirmationEmail($customerEmail, $customerName, $maDonHang, $orderDetails, $tongTienSauGiamGia, $phiVanChuyen, $thoiGianGiao) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'anhhuyy2802@gmail.com'; // Thay bằng email của bạn
        $mail->Password   = 'zofi ilrc gplu jjyp'; // Thay bằng mật khẩu ứng dụng hoặc mật khẩu email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Hoặc PHPMailer::ENCRYPTION_SMTPS nếu bạn muốn sử dụng SSL
        $mail->Port       = 587; // 587 cho STARTTLS, 465 cho SSL

        // Người gửi và người nhận
        $mail->setFrom('anhhuyy2802@gmail.com', 'T1 Store'); 
        $mail->addAddress($customerEmail, $customerName); // Thêm địa chỉ người nhận
        $mail->isHTML(true);
        $mail->Subject = 'Xac Nhan Don Hang #' . $maDonHang;

        // Tạo nội dung email
        $body = "
        <h1>Cảm ơn bạn đã đặt hàng tại cửa hàng T1 Store!</h1>
        <p>Xin chào <strong>{$customerName}</strong>,</p>
        <p>Đơn hàng của bạn đã được chúng tôi xác nhận và đang trong quá trình xử lý. Dưới đây là chi tiết đơn hàng của bạn:</p>
        <h2>Mã Đơn Hàng: {$maDonHang}</h2>
        <h3>Chi Tiết Đơn Hàng:</h3>
        <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá (VNĐ)</th>
                    <th>Thành Tiền (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
        ";

        foreach ($orderDetails as $item) {
            $body .= "
                <tr>
                    <td>{$item['tenSanPham']}</td>
                    <td>{$item['soLuong']}</td>
                    <td>" . number_format($item['donGia'], 0, ',', '.') . "</td>
                    <td>" . number_format($item['thanhTien'], 0, ',', '.') . "</td>
                </tr>
            ";
        }

        $body .= "
            </tbody>
        </table>
        <h3>Tổng Tiền Sau Giảm Giá: " . number_format($tongTienSauGiamGia - $phiVanChuyen, 0, ',', '.') . " VNĐ</h3>
        <h3>Phí Vận Chuyển: " . number_format($phiVanChuyen, 0, ',', '.') . " VNĐ</h3>
        <h3>Tổng Tiền Thanh Toán: " . number_format($tongTienSauGiamGia, 0, ',', '.') . " VNĐ</h3>
        <h3>Thời Gian Giao Dự Kiến: " . $thoiGianGiao . "</h3>
        <p>Chúng tôi sẽ thông báo cho bạn khi đơn hàng của bạn được giao thành công.</p>
        <p>Trân trọng,</p>
        <p>Đội ngũ T1 Store</p>
        ";

        $mail->Body    = $body;
        $mail->AltBody = 'Cảm ơn bạn đã đặt hàng. Chi tiết đơn hàng của bạn: Mã Đơn Hàng: ' . $maDonHang . ', Tổng Tiền: ' . number_format($tongTienSauGiamGia, 0, ',', '.') . ' VNĐ. Phí Vận Chuyển: ' . number_format($phiVanChuyen, 0, ',', '.') . ' VNĐ. Thời Gian Giao Dự Kiến: ' . $thoiGianGiao . '.';
        $mail->send();
    } catch (Exception $e) {
        error_log("Không thể gửi email: {$mail->ErrorInfo}");
    }
}
if (!isset($_POST["tongTien"]) || !is_numeric($_POST["tongTien"])) {
    die("Dữ liệu không hợp lệ.");
}
// Tạo mã đơn hàng tự động tăng
$query = "SELECT MAX(CAST(SUBSTRING(maDonHang, 5) AS UNSIGNED)) AS max_id FROM don_dat_hang";
$statement = $dbh->prepare($query);
$statement->execute();
$max_id = $statement->fetchColumn();
$count = ($max_id !== null) ? ($max_id + 1) : 1; // Xử lý trường hợp không có đơn hàng trước đó
$maDonHang = "DH" . str_pad($count, 4, '0', STR_PAD_LEFT); // Đảm bảo mã đơn hàng có độ dài cố định, ví dụ: DH0001

// Các thông tin còn lại của đơn đặt hàng
$maKhachHang = $_SESSION["taiKhoan"]["maKhachHang"];
$maXa = $_SESSION["taiKhoan"]["maXa"];
$customerName = $_SESSION["taiKhoan"]["hoKhachHang"] . ' ' . $_SESSION["taiKhoan"]["tenKhachHang"];
$customerEmail = $_SESSION["taiKhoan"]["email"];
date_default_timezone_set("Asia/Ho_Chi_Minh");
$ngayDat = date("Y-m-d H:i:s");
$tongTienInput = $_POST["tongTien"];

// Lấy maTinh từ maXa
$get_maTinh = $dbh->prepare(
    "SELECT tinh.maTinh 
     FROM xa 
     JOIN huyen ON xa.maHuyen = huyen.maHuyen 
     JOIN tinh ON huyen.maTinh = tinh.maTinh 
     WHERE xa.maXa = :maXa"
);
$get_maTinh->bindParam(':maXa', $maXa);
$get_maTinh->execute();
$maTinh = $get_maTinh->fetchColumn();

// Lấy phiVanChuyen và thoiGianGiao từ shipping_fee
$get_shipping = $dbh->prepare(
    "SELECT phiVanChuyen, thoiGianGiao 
     FROM shipping_fee 
     WHERE maTinh = :maTinh"
);
$get_shipping->bindParam(':maTinh', $maTinh);
$get_shipping->execute();
$shipping = $get_shipping->fetch(PDO::FETCH_ASSOC);

if ($shipping) {
    $phiVanChuyen = $shipping['phiVanChuyen'];
    $thoiGianGiao = $shipping['thoiGianGiao'];
} else {
    // Mặc định nếu không tìm thấy thông tin shipping_fee
    $phiVanChuyen = 50000;
    $thoiGianGiao = '3-7 ngày';
}

// Tính tổng tiền bao gồm phí vận chuyển
$tongTienSauGiamGia = $tongTienInput + $phiVanChuyen;

// Kiểm tra và tạo điểm tích lũy nếu chưa có
$checkIfExists = $dbh->prepare("SELECT COUNT(*) FROM diem_tich_luy WHERE maKhachHang = :maKhachHang");
$checkIfExists->bindParam(':maKhachHang', $maKhachHang);
$checkIfExists->execute();

if ($checkIfExists->fetchColumn() == 0) {
    // Nếu chưa có, tạo một bản ghi mới
    $insertNewRecord = $dbh->prepare("INSERT INTO diem_tich_luy (maKhachHang, tongDiem, capBac) VALUES (:maKhachHang, 0, 'Dong')");
    $insertNewRecord->bindParam(':maKhachHang', $maKhachHang);
    $insertNewRecord->execute();
}

// Cập nhật điểm tích lũy
$diemTichLuy = floor($tongTienInput / 1000000); // 1 điểm cho mỗi triệu VND
$updatePoints = $dbh->prepare("UPDATE diem_tich_luy SET tongDiem = tongDiem + :diemTichLuy WHERE maKhachHang = :maKhachHang");
$updatePoints->bindParam(':diemTichLuy', $diemTichLuy);
$updatePoints->bindParam(':maKhachHang', $maKhachHang);
$updatePoints->execute();

// Cập nhật cấp bậc nếu cần thiết
$checkPoints = $dbh->prepare("SELECT tongDiem FROM diem_tich_luy WHERE maKhachHang = :maKhachHang");
$checkPoints->bindParam(':maKhachHang', $maKhachHang);
$checkPoints->execute();
$currentPoints = $checkPoints->fetchColumn();

$capBac = '';
if ($currentPoints >= 30) {
    $capBac = 'Vang';
} elseif ($currentPoints >= 20) {
    $capBac = 'Bac';
} elseif ($currentPoints >= 10) {
    $capBac = 'Dong';
}

// Cập nhật cấp bậc
if ($capBac) {
    $updateRank = $dbh->prepare("UPDATE diem_tich_luy SET capBac = :capBac WHERE maKhachHang = :maKhachHang");
    $updateRank->bindParam(':capBac', $capBac);
    $updateRank->bindParam(':maKhachHang', $maKhachHang);
    $updateRank->execute();
}
$thanhtoan = isset($_POST['redirect']) ? 'ONLINE' : 'COD';
// Thực hiện tạo đơn hàng với tổng tiền đã bao gồm phí vận chuyển
$query = "INSERT INTO don_dat_hang (maDonHang, maKhachHang, ngayDat, ngayGiao, tinhTrang, tongTien, maNhanVien, hoTen, sdt, email, diaChi, thanhtoan, diaChiGiaoHangMoi) 
          VALUES (:maDonHang, :maKhachHang, :ngayDat, NULL, b'11', :tongTien, NULL, :hoTen, :sdt, :email, :diaChi, :thanhtoan, :diaChiGiaoHangMoi)";
$statement = $dbh->prepare($query);
$statement->bindParam(':maDonHang', $maDonHang);
$statement->bindParam(':maKhachHang', $maKhachHang);
$statement->bindParam(':ngayDat', $ngayDat);
$statement->bindParam(':tongTien', $tongTienSauGiamGia);
// Thêm thông tin khách hàng từ session hoặc form
$hoTen = $_SESSION['taiKhoan']['hoKhachHang'] . ' ' . $_SESSION['taiKhoan']['tenKhachHang'];
$sdt = $_SESSION['taiKhoan']['dienThoai'];
$email = $_SESSION['taiKhoan']['email'];
$diaChi = isset($_SESSION['taiKhoan']['diaChiCuThe']) && !empty($_SESSION['taiKhoan']['diaChiCuThe']) 
    ? $_SESSION['taiKhoan']['diaChiCuThe'] 
    : '';

$diaChi .= isset($diachi->tenXa) && !empty($diachi->tenXa) ? ', ' . $diachi->tenXa : '';
$diaChi .= isset($diachi->tenHuyen) && !empty($diachi->tenHuyen) ? ', ' . $diachi->tenHuyen : '';
$diaChi .= isset($diachi->tenTinh) && !empty($diachi->tenTinh) ? ', ' . $diachi->tenTinh : '';
$diaChi = !empty($diaChi) ? $diaChi : 'Địa chỉ không xác định';
    // Kiểm tra xem người dùng có nhập thông tin mới không
    if (!empty($_POST['newName'])) {
        $hoTen = $_POST['newName'];
    }
    if (!empty($_POST['newPhone'])) {
        $sdt = $_POST['newPhone'];
    }
    if (!empty($_POST['newEmail'])) {
        $email = $_POST['newEmail'];
    }
    if (!empty($_POST['newAddress'])) {
        $diaChi = $_POST['newAddress'];
    }    
    $statement->bindParam(':hoTen', $hoTen);
    $statement->bindParam(':sdt', $sdt);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':diaChi', $diaChi);
    $statement->bindParam(':thanhtoan', $thanhtoan);
    $statement->bindParam(':diaChiGiaoHangMoi', $diaChiGiaoHangMoi);
    $statement->execute();

// Lấy thông tin giỏ hàng hiện tại
$get_giohang = $dbh->prepare(
  "SELECT 
        gio_hang.soLuong, 
        san_pham.maSanPham, 
        san_pham.tenSanPham, 
        san_pham.donGiaBan, 
        san_pham.hinhAnh, 
        giam_gia.maLoai, 
        CASE 
            WHEN giam_gia.maLoai = 1 AND giam_gia.ngayBatDau <= CURDATE() AND giam_gia.ngayKetThuc >= CURDATE() THEN giam_gia.giaTriGiam 
            WHEN giam_gia.maLoai = 2 AND giam_gia.ngayBatDau <= CURDATE() AND giam_gia.ngayKetThuc >= CURDATE() THEN giam_gia.giaTriGiam 
            ELSE 0 
        END AS giaTriGiam 
    FROM gio_hang 
    JOIN san_pham ON gio_hang.maSanPham = san_pham.maSanPham 
    LEFT JOIN giam_gia ON san_pham.maSanPham = giam_gia.maSanPham 
    WHERE gio_hang.maKhachHang = :maKhachHang"
);
$get_giohang->bindParam(':maKhachHang', $maKhachHang);
$get_giohang->execute();
$get_giohang->setFetchMode(PDO::FETCH_OBJ);

// Mảng để lưu chi tiết đơn hàng
$orderDetails = [];
$tongTienSauGiamGia = 0;

while ($row = $get_giohang->fetch()) {
    // Đưa từng sản phẩm trong giỏ vào chi tiết đơn đặt hàng
    $maSanPham = $row->maSanPham;
    $soLuong = $row->soLuong;
    if ($row->maLoai == 1) {
        // Giảm giá cố định
        $donGia = $row->donGiaBan - $row->giaTriGiam;
    } elseif ($row->maLoai == 2) {
        // Giảm giá theo phần trăm
        $donGia = $row->donGiaBan - ($row->donGiaBan * $row->giaTriGiam / 100);
    } else {
        $donGia = $row->donGiaBan;
    }
    $thanhTien = $donGia * $soLuong;

    // Thêm chi tiết vào mảng
    $orderDetails[] = [
        'maSanPham' => $maSanPham,
        'tenSanPham' => $row->tenSanPham,
        'soLuong' => $soLuong,
        'donGia' => $donGia,
        'thanhTien' => $thanhTien
    ];

    // Thêm vào chi tiết đơn hàng trong cơ sở dữ liệu
    $insert_chddh = "INSERT INTO chi_tiet_don_dat_hang (maDonHang, maSanPham, soLuong, donGia, thanhTien, hoTen, sdt, email, diaChi) 
                 VALUES (:maDonHang, :maSanPham, :soLuong, :donGia, :thanhTien, :hoTen, :sdt, :email, :diaChi)";
    $insert = $dbh->prepare($insert_chddh);
    $insert->bindParam(':maDonHang', $maDonHang);
    $insert->bindParam(':maSanPham', $maSanPham);
    $insert->bindParam(':soLuong', $soLuong);
    $insert->bindParam(':donGia', $donGia);
    $insert->bindParam(':thanhTien', $thanhTien);
    // Thêm thông tin khách hàng từ session hoặc form
    $insert->bindParam(':hoTen', $hoTen);
    $insert->bindParam(':sdt', $sdt);
    $insert->bindParam(':email', $email);
    $insert->bindParam(':diaChi', $diaChi);
    $insert->execute();
    $tongTienSauGiamGia += $thanhTien;
}

// Thêm phí vận chuyển vào tổng tiền
$tongTienSauGiamGia += $phiVanChuyen;

// Lưu thông tin vận chuyển vào bảng `shipping`
$insert_shipping = "INSERT INTO shipping (maDonHang, phiVanChuyen, thoiGianGiao) 
                   VALUES (:maDonHang, :phiVanChuyen, :thoiGianGiao)";
$shipping_stmt = $dbh->prepare($insert_shipping);
$shipping_stmt->bindParam(':maDonHang', $maDonHang);
$shipping_stmt->bindParam(':phiVanChuyen', $phiVanChuyen);
$shipping_stmt->bindParam(':thoiGianGiao', $thoiGianGiao);
$shipping_stmt->execute();

// Xóa giỏ hàng sau khi đặt
$delete_giohang = "DELETE FROM gio_hang WHERE gio_hang.maKhachHang = :maKhachHang";
$delete = $dbh->prepare($delete_giohang);
$delete->bindParam(':maKhachHang', $maKhachHang);
$delete->execute();

// Lấy cấp bậc của khách hàng
$getRank = $dbh->prepare("SELECT capBac FROM diem_tich_luy WHERE maKhachHang = :maKhachHang");
$getRank->bindParam(':maKhachHang', $maKhachHang);
$getRank->execute();
$capBac = $getRank->fetchColumn();

// Lấy mức giảm giá dựa trên cấp bậc
$discountQuery = $dbh->prepare("SELECT giamGia FROM cap_bac WHERE tenCapBac = :capBac");
$discountQuery->bindParam(':capBac', $capBac);
$discountQuery->execute();
$discountRate = $discountQuery->fetchColumn();

// Áp dụng giảm giá nếu có
if ($discountRate) {
    $tongTienSauGiamGia -= ($tongTienSauGiamGia * ($discountRate / 100));
}
// Gửi email xác nhận đơn hàng
sendOrderConfirmationEmail(
    $customerEmail, 
    $customerName, 
    $maDonHang, 
    $orderDetails, 
    $tongTienSauGiamGia, 
    $phiVanChuyen, 
    $thoiGianGiao
);
if (isset($_POST['redirect'])) {
    
    $vnp_TmnCode = "ZHBV8THR"; 
    $vnp_HashSecret = "RRB48HKIJPBDXWZPOQ6O9FBQ37YCIKYN"; 
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost/website/pages/cart_confirm_order.php";
    $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";

    $vnp_TxnRef = rand(00, 9999);
    $vnp_OrderInfo = 'Noi dung thanh toan';
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $tongTienSauGiamGia * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $sql = "INSERT INTO don_dat_hang (thanhtoan) VALUES ('ONLINE')";
    header('Location: ' . $vnp_Url);
    exit();

} else {
    $sql = "INSERT INTO don_dat_hang (thanhtoan) VALUES ('COD')";
    header("Location: ../pages/cart_confirm_order.php"); 
    exit();
}
?>
<script>
    app.post('/submitOrder', async (req, res) => {
  const {
    userName, userPhone, userEmail, userAddress,
    newName, newPhone, newEmail, newAddress
  } = req.body;

  try {
    // Câu lệnh SQL để thêm đơn hàng với thông tin địa chỉ giao thay thế
    const query = `
      INSERT INTO don_dat_hang (hoTen, sdt, email, diaChi, diaChiGiaoHangMoi)
      VALUES (?, ?, ?, ?, ?)
    `;

    const values = [
      userName, userPhone, userEmail, userAddress,
      newName ? `${newName}, ${newPhone}, ${newEmail}, ${newAddress}` : null
    ];

    await database.execute(query, values);
    res.json({ success: true });
  } catch (error) {
    res.json({ success: false, message: error.message });
  }
});

</script>