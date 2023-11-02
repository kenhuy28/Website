<!--Chức năng tìm kiếm-->

<?php include '../templates/header.php';
require_once('../includes/config.php');
$sql = "SELECT * FROM thuong_hieu";
$stmt = $dbh->query($sql);
$thuongHieu = $stmt->fetchAll(PDO::FETCH_ASSOC);
$SearchString = $_GET['SearchString'];
// Lấy giá trị từ ô tìm kiếm
$sql = "SELECT p.*,b.tenThuongHieu FROM san_pham p
                 JOIN thuong_hieu b ON p.maThuongHieu = b.maThuongHieu
                 JOIN loai_san_pham c ON c.maLoai = p.maLoai
                 WHERE p.tenSanPham LIKE '%$SearchString%' OR b.tenThuongHieu LIKE '%$SearchString%' OR c.tenLoai LIKE '%$SearchString%'";
$stmt = $dbh->query($sql);
$sanPham = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h2 style="text-align: center;">Danh Sách Tìm Kiếm</h2>
<div class="timKiem_page">

    <div class="timKiem_page_left">
        <div class="catalog_timKiem">
            <h6>CATEGORIES</h6>
            <ul>
                <li>
                    <a href="">
                        Chó
                    </a>
                </li>
                <li>
                    <a href="">
                        Mèo
                    </a>
                </li>
                <li>
                    <a href="">
                        Thiết bị thông minh
                    </a>
                </li>
                <li>
                    <a href="">
                        Hàng mới về
                    </a>
                </li>
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
                    <button class='button_product'>Thêm vào giỏ hàng</button>
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