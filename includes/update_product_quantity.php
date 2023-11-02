<?php
include("config.php");

$maSanPham = $_POST['maSanPham'];
$maKhachHang = $_POST['maKhachHang'];
$quantityChange = (int) $_POST['quantityChange'];

// Thực hiện cập nhật số lượng sản phẩm
if ($quantityChange != 0) {
    $query = "UPDATE gio_hang SET soLuong = soLuong + $quantityChange WHERE maSanPham ='$maSanPham' and maKhachHang = '$maKhachHang'";
    $statement = $dbh->prepare($query);
    $success = $statement->execute();
}
?>