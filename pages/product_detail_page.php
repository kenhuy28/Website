<!--peoduct detail-->
<?php include '../templates/header.php';
$product_id = "sp0001";
$query = "SELECT maSanPham, tenSanPham, donGiaBan, maLoai, soLuong, hinhAnh, moTa, tenThuongHieu FROM san_pham JOIN thuong_hieu on san_pham.maThuongHieu = thuong_hieu.maThuongHieu WHERE maSanPham= '$product_id'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$sanPham = $stmt->fetch(PDO::FETCH_OBJ);

?>


<div class="chiTietSanPham">
    <?php

    if ($sanPham->soLuong != 0) {
        echo $sanPham->maSanPham;
        $button = '<button name="submit" style="font-size:20px; color:red; font-weight:bold;" productid="' . $sanPham->maSanPham . '"  onclick="addToCart(this)">Thêm vào giỏ hàng</button>';
    } else {
        $button = '<button name="submit" style="font-size:20px; color:red; font-weight:bold;" value="HẾT HÀNG" disabled>HẾT HÀNG</button>';
    }

    echo '

        <div class="chiTietSanPham_left">
            <img src="../assets/img/sanpham/' . $sanPham->hinhAnh . ' " style="height:500px; width:500px;">
            <div class="chiTietSanPham_giamgia">Giảm giá</div>
        </div>
        <div class="chiTietSanPham_right">
            <h4>' . $sanPham->tenSanPham . '</h6>
                <p>Tên thương hiệu:
                    ' . $sanPham->tenThuongHieu . '
                </p>
                <div>
                    <h1 style="color:red;">
                        ' . $sanPham->donGiaBan . '
                    </h1>
                </div>
                <div>
                    <h3>
                        Số lượng còn: ' . $sanPham->soLuong . '

                    </h3>
                </div>
                
                <div>
                ' . $button . '
                </div>
                <div class="chiTietSanPham_right_mota">
                    <span>Mô tả: </span>
                    ' . $sanPham->moTa . '
                </div>
        </div>';

    ?>
</div>
<?php include '../templates/footer.php' ?>