<?php

// Lấy mã sản phẩm từ kết quả của sản phẩm hiện tại
$maSanPham = $result->maSanPham; // Dùng mã sản phẩm từ sản phẩm hiện tại (có trong $result từ product)

$technicalSpecs = [];

// Truy vấn để lấy các thông số kỹ thuật của sản phẩm
$query = "SELECT loaiThongSo, tenThongSo, giaTriThongSo FROM thong_so_ky_thuat WHERE maSanPham = :maSanPham";
$statement = $dbh->prepare($query);
$statement->bindParam(':maSanPham', $maSanPham, PDO::PARAM_STR);

if ($statement->execute()) {
    // Sử dụng FETCH_ASSOC để dễ dàng truy cập các trường
    $technicalSpecs = $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Trả về mảng các thông số kỹ thuật
return $technicalSpecs;
?>
