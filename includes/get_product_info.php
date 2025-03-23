<?php
// includes/get_product_info.php

// Kết nối đến cơ sở dữ liệu
require_once 'config.php'; // Đảm bảo đường dẫn đúng

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $maSanPham = $_GET['id'];

    // Chuẩn bị và thực thi câu truy vấn
    $stmt = $dbh->prepare("SELECT maSanPham, tenSanPham, hinhAnh FROM san_pham WHERE maSanPham = :maSanPham");
    $stmt->bindParam(':maSanPham', $maSanPham, PDO::PARAM_STR);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(["error" => "Mã sản phẩm không được cung cấp."]);
    }
} else {
    echo json_encode(["error" => "Mã sản phẩm không được cung cấp."]);
}
?>
