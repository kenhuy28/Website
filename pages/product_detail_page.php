<!--peoduct detail-->
<?php include '../templates/header.php';
$product_id = $_POST['maSanPham'];
$query = "SELECT maSanPham, tenSanPham, donGiaBan, maLoai, soLuong, hinhAnh, moTa, tenThuongHieu FROM san_pham JOIN thuong_hieu on san_pham.maThuongHieu = thuong_hieu.maThuongHieu WHERE maSanPham= 'sp0001'";
$statement = $dbh->prepare($query);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);

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
<div class="chiTietSanPham">

    <?php

    while ($row = $statement->fetch()) {
        $maSanPham = $row->maSanPham;
        if ($row->soLuong != 0) {
            $button = '<input type="submit" productid=' . $maSanPham . ' onclick="addToCart(this)" name="submit" class="button_product_chiTiet" style="font-size:20px; color:red; font-weight:bold;"
            value="THÊM VÀO GIỎ HÀNG">';
        } else {
            $button = '<input type="submit" name="submit" style="font-size:20px; color:red; font-weight:bold;" value="HẾT HÀNG" disabled>';
        }

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

                ' . $button . '

                <div class="chiTietSanPham_right_mota">
                    <span>Mô tả: </span>
                    ' . $row->moTa . '
                </div>
        </div>';
    }
    ?>
</div>
<?php include '../templates/footer.php' ?>