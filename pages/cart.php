<?php include '../templates/header.php' ?>
<?php $_SESSION["maKhachHang"] = "KH0001"; ?>
<?php
$statement = $dbh->prepare(
    "SELECT 
        gio_hang.soLuong, 
        san_pham.maSanPham, 
        san_pham.tenSanPham, 
        san_pham.donGiaBan, 
        san_pham.hinhAnh, 
        thuong_hieu.tenThuongHieu, 
        IFNULL(giam_gia.loaiGiamGia, 0) AS loaiGiamGia, 
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
    WHERE gio_hang.maKhachHang = '" . $_SESSION["maKhachHang"] . "'"
);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    function botSanPham(element) {
        var maSanPham = element.getAttribute("maSanPham");
        updateProductQuantity(maSanPham, -1); // Giảm số lượng sản phẩm

        var maSanPham = element.getAttribute("maSanPham");
        var quantityElement = document.querySelector('.soLuong' + maSanPham);
        var currentQuantity = parseInt(quantityElement.textContent);
        if (!isNaN(currentQuantity) && currentQuantity > 0) {
            quantityElement.textContent = currentQuantity - 1;
            updateTotalPrice(); // Cập nhật tổng tiền
        }
    }

    function themSanPham(element) {
        var maSanPham = element.getAttribute("maSanPham");
        updateProductQuantity(maSanPham, 1); // Tăng số lượng sản phẩm

        var maSanPham = element.getAttribute("maSanPham");
        var quantityElement = document.querySelector('.soLuong' + maSanPham);
        var currentQuantity = parseInt(quantityElement.textContent);
        if (!isNaN(currentQuantity)) {
            quantityElement.textContent = currentQuantity + 1;
            updateTotalPrice(); // Cập nhật tổng tiền
        }
    }

    // Hàm tính tổng tiền và cập nhật giao diện
    function updateTotalPrice() {
        var total = 0;

        // Lặp qua các sản phẩm và tính tổng tiền
        var items = document.querySelectorAll('.body_table_item');
        items.forEach(function (item) {
            var quantity = parseInt(item.querySelector('.soLuong').textContent);
            var price = parseFloat(item.querySelector('.body_table_title[style="width: 15%; font-weight: 700;"]').textContent);
            var discount = parseFloat(item.querySelector('.body_table_title[style="width: 15%"]').textContent);

            if (!isNaN(quantity) && !isNaN(price) && !isNaN(discount)) {
                total += (quantity * price) - (quantity * discount);
            }
        });

        // Cập nhật tổng tiền trên giao diện
        var totalPriceElement = document.querySelector('.total-price');
        totalPriceElement.textContent = total.toFixed(2); // Định dạng tổng tiền theo mong muốn
    }

    function updateProductQuantity(maSanPham, quantityChange) {
        // Thực hiện Ajax request để cập nhật số lượng sản phẩm
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo $rootPath . "/includes/update_product_quantity.php"; ?>', // Đường dẫn đến file xử lý cập nhật số lượng sản phẩm
            data: { maSanPham: maSanPham, maKhachHang: '<?php echo $_SESSION['maKhachHang']; ?>', quantityChange: quantityChange }
        });
    }


</script>

<h6>Trang Chủ > Giỏ Hàng Của Bạn</h6>
<div class="cart_title">GIỎ HÀNG CỦA BẠN</div>
<div class="yellow_space"></div>
<div class="cart">
    <div class="cart_table">
        <div class="header_table">
            <div class="header_table_title" style="width: 40%;">
                SẢN PHẨM
            </div>
            <div class="header_table_title" style="width: 15%">
                GIÁ
            </div>
            <div class="header_table_title" style="width: 15%">
                SỐ LƯỢNG
            </div>
            <div class="header_table_title" style="width: 15%">
                GIẢM GIÁ
            </div>
            <div class="header_table_title" style="width: 10%">
                THÀNH TIỀN
            </div>
            <div class="header_table_title" style="width: 5%">

            </div>
        </div>
        <div class="body_table">
            <?php
            while ($row = $statement->fetch()) {
                echo '<div class="body_table_item">';
                // echo $row->maThuongHieu; 
                echo '<div class="body_table_title body_table_title_sanpham" style="width: 37%;">
                            <img src="' . $rootPath . '/assets/img/sanpham/' . trim($row->hinhAnh) . '" alt="" style="height: 120px; width: 90px;">
                            <div class="decription_product">
                                <div>
                                <a href="" class="title_product_cart" style="color: black">'
                    . $row->tenSanPham .
                    '</a>   
                                </div>
                                <div style="margin-top: 10px;">
                                <a href="" class="th_product_cart" style="color: #0b84ee; font-weight: 700; ">'
                    . $row->tenThuongHieu .
                    '</a>
                                </div>
                            </div>
                        </div>
                        <div class="body_table_title" style="width: 15%; font-weight: 700;">'
                    . $row->donGiaBan .
                    '</div>
                    <div class="body_table_title" style="width: 15%">
                            <div class="body_table_title_soluong">
                                <div onclick="botSanPham(this)" maSanPham="' . $row->maSanPham . '">
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            <div class="soLuong' . $row->maSanPham . '">'
                    . $row->soLuong
                    . '</div>
                                <div onclick="themSanPham(this)" maSanPham="' . $row->maSanPham . '">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="body_table_title" style="width: 15%">'
                    . $row->giaTriGiam . (($row->loaiGiamGia == 0) ? (" %") : (" VNĐ"))
                    . '</div>
                        <div class="body_table_title total-price" style="width: 10%; font-weight: 700; ">'
                    // . ($row->donGiaBan * $row->soLuong - (($row->loaiGiamGia == 0) ? ($row->giaTriGiam * $row->donGiaBan * $row->soLuong / 100) : ($row->soLuong * $row->giaTriGiam)))
                    . '</div>
                        <div class="body_table_title" style="min-width: 5%;" onclick="xoaSanPham()">
                            <i class="fa-solid fa-x"></i>
                            </div></div>';
            } ?>
        </div>
    </div>
    <div class="cart_checkcout" style="width: 350px;">
        <h6 style="margin-top: 0">TỔNG SỐ TIỀN</h6>
        <div class="cart_checkcout_title">
            <div>Tổng số tiền:</div>
            <div>480.000 VNĐ</div>
        </div>
        <a href="<?php echo $rootPath . "/pages/cart_order.php"; ?> "><button>Đặt Hàng</button></a>
        <a href="<?php echo $rootPath . "/pages/product_page.php"; ?> "><button>Tiếp Tục Mua Sắm</button></a>
        <button onclick="xoaTatCaSanPham()">Xóa Tất Cả Sản Phẩm</button>
    </div>
</div>
<?php include '../templates/footer.php' ?>