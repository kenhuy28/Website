<?php
//tạo mã phiếu tự động
$maSanPham = "SP";

$query = "SELECT COUNT(*) FROM `san_pham`";
$statement = $dbh->prepare($query);
$statement->execute();

// Sử dụng fetchColumn
$count = $statement->fetchColumn() + 1;
if ($count <= 9) {
    $maSanPham .= "000" . $count;
} else if ($count <= 99) {
    $maSanPham .= "00" . $count;
} else if ($count <= 999) {
    $maSanPham .= "0" . $count;
} else {
    $maSanPham .= "" . $count;
}

?>