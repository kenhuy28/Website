<?php
include("config.php");
// INSERT INTO `giam_gia` (`maGiamGia`, `maSanPham`, `maLoai`, `giaTriGiam`, `ngayBatDau`, `ngayKetThuc`) VALUES ('GG0004', 'SP0004', b'01', '50000', '2023-11-01', '2023-11-23');

$maGiamGia = "GG";
$query = "SELECT MAX(CAST(SUBSTRING(giam_gia.maGiamGia, 4) AS SIGNED)) AS max_id FROM giam_gia";
$statement = $dbh->prepare($query);
$statement->execute();
$count = $statement->fetchColumn() + 1;
$index = strval($count);
$temp = array("", "0", "00", "000");
$maGiamGia = $maGiamGia . $temp[4 - strlen($index)] . $index;


$maSanPham = $_POST['sanPham'];
$maLoai = $_POST['loaiGiamGia'];
$giaTriGiam = $_POST['giaTriGiam'];
$ngayBatDau = $_POST['ngayBatDau'];
$ngayKetThuc = $_POST['ngayKetThuc'];

$query = "INSERT INTO `giam_gia` (`maGiamGia`, `maSanPham`, `maLoai`, `giaTriGiam`, `ngayBatDau`, `ngayKetThuc`) VALUES ('$maGiamGia', '$maSanPham', b'$maLoai', '$giaTriGiam', '$ngayBatDau', '$ngayKetThuc');";
$statement_add = $dbh->prepare($query);
$statement_add->execute();

header("Location: ../pages/discount.php");
?>