<?php
include '../includes/config.php';
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $productIndex = $input['productIndex'] ?? null;
    $newCategory = $input['newCategory'] ?? null;

    if ($productIndex !== null && $newCategory !== null && isset($_SESSION['uploaded_images'][$productIndex])) {
        $_SESSION['uploaded_images'][$productIndex]['category'] = $newCategory; // Cập nhật loại sản phẩm
        echo json_encode(['success' => true]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ!']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ!']);
exit;
?>
