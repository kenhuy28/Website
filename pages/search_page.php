<!--Chức năng tìm kiếm-->

<?php include '../templates/header.php';
    require_once('../includes/config.php');
    $sql = "SELECT * FROM thuong_hieu";
    $stmt = $dbh->query($sql);
    $thuongHieu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $SearchString = $_GET['SearchString'];
    echo $SearchString;
    
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
                ".$row['tenThuongHieu']."
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
                    <div class="product_item product_item_timkiem">
                        <img src="../assets/img/img_product/sanpham.png" alt="">
                        <div class="product_thuonghieu">
                            <h5>Paddy</h5>
                        </div>
                        <div class="product_name">
                            <h5>Bát Ăn Cho Chó Mèo Bằng Nhựa Hình Mèo May Mắn</h5>
                        </div>
                        <div class="product_price">
                            <h5>55.000đ</h5>
                        </div>
                        <button class="button_product">Thêm vào giỏ hàng</button>
                        <div class="xem_icon">
                            <i class="fa-regular fa-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../templates/footer.php' ?>