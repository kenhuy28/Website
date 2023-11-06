<!--peoduct detail-->
<?php include '../templates/header.php';

$query = "SELECT maSanPham, tenSanPham, donGiaBan, maLoai, soLuong, hinhAnh, moTa, tenThuongHieu FROM san_pham JOIN thuong_hieu on san_pham.maThuongHieu = thuong_hieu.maThuongHieu WHERE maSanPham= 'sp0001'";
$statement = $dbh->prepare($query);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
if (isset($_POST["submit"])) {
}

?>

<div class="chiTietSanPham">
    <?php
    while ($row = $statement->fetch()) {
        if ($row->soLuong != 0) {
            $button = '<input type="submit" name="submit" class="button_product_chiTiet" style="font-size:20px; color:red; font-weight:bold;"
            value="THÊM VÀO GIỎ HÀNG">';
        } else {
            $button = '<input type="submit" name="submit" style="font-size:20px; color:red; font-weight:bold;" value="HẾT HÀNG" disabled>';
        }
        $maSanPham = $row->maSanPham;
        $soLuong = $row->soLuong;
        echo '

        <div class="chiTietSanPham_left">
            <img src="../assets/img/sanpham/' . $row->hinhAnh . ' " style="height:500px; width:500px;">
            <div class="chiTietSanPham_giamgia">Giảm giá</div>
        </div>
        <div class="chiTietSanPham_right">
            <h4>' . $row->tenSanPham . '</h6>
                <p>Tên thương hiệu:
                    ' . $row->tenThuongHieu . '
                </p>
                <div>
                    <h1 style="color:red;">
                        ' . $row->donGiaBan . '
                    </h1>
                </div>
                <div>
                    <h3>
                        Số lượng còn: ' . $row->soLuong . '

                    </h3>
                </div>
                <form acction=""  method="POST">
                ' . $button . '
                </form>
                <div class="chiTietSanPham_right_mota">
                    <span>Mô tả: </span>
                    ' . $row->moTa . '
                </div>
        </div>';
    }
    ?>
    <style>
        .submit
    </style>
</div>
<?php include '../templates/footer.php' ?>