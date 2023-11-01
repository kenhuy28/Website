<?php
include 'config.php';
// Get the data from AJAX
$data = $_POST["maPhieuNK"];
// Check if the data is null
if ($data === null) {
    // Handle the error
    exit('Invalid data');
} else {
    echo $maPhieuNK = $data;
}
// $statement = $dbh->prepare("INSERT INTO `phieu_nhap`(`maPhieuNhap`, `ngayNhap`, `maNhanVien`) VALUES ('" . $data['maPhieuNK'] . "','" . $data['ngayNK'] . "','AD0003')");
// $statement->execute();
?>