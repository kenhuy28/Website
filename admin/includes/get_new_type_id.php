<?php
//tạo mã thương hiệu tự động
$maLoai = "LSP";

$query = "SELECT COUNT(*) FROM `loai_san_pham`";
$statement = $dbh->prepare($query);
$statement->execute();

// Sử dụng fetchColumn
$count = $statement->fetchColumn() + 1;
if ($count <= 9) {
    $maLoai .= "00" . $count;
} else if ($count <= 99) {
    $maLoai .= "0" . $count;
} else {
    $maLoai .= "" . $count;
}

?>