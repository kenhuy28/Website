<?php
include 'config.php';

$maDonHang = $_GET['id'];
$hanhDong = $_GET['nut'];

if ($hanhDong == 'huy') {
    echo "hủy";
} else if ($hanhDong == "xacNhan") {
    $statement = $dbh->prepare("UPDATE don_dat_hang SET tinhTrang = b'10',  WHERE maDonHang = '" . $maDonHang . "'");
    $statement->execute();
    $statement = $dbh->prepare("UPDATE san_pham set soLuong = soLuong - (SELECT soLuong from chi_tiet_don_dat_hang 
    WHERE san_pham.maSanPham = chi_tiet_don_dat_hang.maSanPham and maDonHang = '" . $maDonHang . "')
    WHERE maSanPham IN (
        SELECT maSanPham
        FROM chi_tiet_don_dat_hang
        WHERE maDonHang = '" . $maDonHang . "'
    );");
} else {
    echo "Giao";
}
?>