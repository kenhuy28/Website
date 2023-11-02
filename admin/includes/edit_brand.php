<?php
$brand_id = $_POST["brand_id"];
$brand_name = $_POST["brand_name"];
echo "<script>console.log(\"111111111111111111111\")</script>";
$statement = $dbh->prepare("UPDATE `thuong_hieu` SET `tenThuongHieu`='" . $brand_name . "' WHERE `maThuongHieu` = '" . $brand_id . "'");
$statement->execute();
echo '<script>window.location.href = "brand_index.php?";</script>';
?>