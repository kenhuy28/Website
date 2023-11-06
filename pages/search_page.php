<!--Chức năng tìm kiếm-->

<?php include '../templates/header.php';
require_once('../includes/config.php');
$sql = "SELECT * FROM thuong_hieu";
$stmt = $dbh->query($sql);
$thuongHieu = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT * FROM loai_san_pham";
$stmt = $dbh->query($sql);
$SearchString = $_GET['SearchString'];
$loaiSanPham = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Lấy giá trị từ ô tìm kiếm
$sql = "SELECT p.*,b.tenThuongHieu FROM san_pham p
                 JOIN thuong_hieu b ON p.maThuongHieu = b.maThuongHieu
                 JOIN loai_san_pham c ON c.maLoai = p.maLoai
                 WHERE p.tenSanPham LIKE '%$SearchString%' OR b.tenThuongHieu LIKE '%$SearchString%' OR c.tenLoai LIKE '%$SearchString%'";
$stmt = $dbh->query($sql);
$sanPham = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addToCart(element) {
        var maSanPham = element.getAttribute("productid");
        var userID = '<?php echo $user_id; ?>';
        excuteToCart(maSanPham, userID);
    }
    function excuteToCart(maSanPham, nguoiDung) {
        jQuery.ajax({
            url: '<?php echo $rootPath . "/includes/update_cart.php"; ?>', // Đường dẫn đến tệp xử lý PHP trên máy chủ
            type: 'POST',
            data: { maSanPham: maSanPham, nguoiDung: nguoiDung }, // Gửi ID sản phẩm lên máy chủ
            dataType: 'json',
            success: function (response) {
                var TB = document.querySelector('#notifacation_all');
                TB.style.bottom = "30px";
                setTimeout(function () {
                    TB.style.bottom = "-50px";
                }, 2000);
                console.log(response);
                updateGioHang(maSanPham, nguoiDung);
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi (nếu có)
                console.log(error);
            }
        });
    }
    function updateGioHang(maSanPham, nguoiDung) {
        jQuery.ajax({
            url: '<?php echo $rootPath . "/includes/count_gio_hang.php"; ?>', // Đường dẫn đến tệp xử lý PHP trên máy chủ
            type: 'POST',
            data: { maSanPham: maSanPham, nguoiDung: nguoiDung }, // Gửi ID sản phẩm lên máy chủ
            dataType: 'json',
            success: function (response) {
                var count = document.querySelector('#count_cart');
                count.textContent = response['soLuongTG'];
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi (nếu có)
                console.log(error);
            }
        });
    }
</script>
<h2 style="text-align: center;">Danh Sách Tìm Kiếm</h2>
<div class="timKiem_page">

    <div class="timKiem_page_left">
        <div class="catalog_timKiem">
            <h6>LOẠI SẢN PHẨM</h6>
            <ul>
                <?php foreach ($loaiSanPham as $row) {
                    echo " <li>
                <a href=''>
                    " . $row['tenLoai'] . "
                </a>
            </li>";
                } ?>


            </ul>
        </div>
        <div class="catalog_timKiem">
            <h6>THƯƠNG HIỆU</h6>
            <ul>
                <?php foreach ($thuongHieu as $row) {
                    echo " <li>
                <a href=''>
                " . $row['tenThuongHieu'] . "
                </a>
            </li>";
                } ?>
            </ul>
        </div>
    </div>
    <div class="timKiem_page_right" style="width: 80%;">
        <div class="product_list">
            <div class="grid">
                <div class="row">
                    <?php foreach ($sanPham as $row) {
                        $productId = $row['maSanPham'];
                        echo "<div class='product_item product_item_timkiem'>
                    <img src='../assets/img/sanpham/" . $row['hinhAnh'] . "' alt=''>
                    <div class='product_thuonghieu'>
                        <h5>" . $row['tenThuongHieu'] . "</h5>
                    </div>
                    <div class='product_name'>
                        <h5>" . $row['tenSanPham'] . "</h5>
                    </div>
                    <div class='product_price'>
                        <h5>" . number_format($row['donGiaBan']) . "đ</h5>
                    </div>
                    <button class='button_product' productid='" . $productId . "'  onclick='addToCart(this)'>Thêm vào giỏ hàng</button>
                    <div class='xem_icon'>
                        <i class='fa-regular fa-eye'></i>
                    </div>
                    </div>";
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/footer.php' ?>