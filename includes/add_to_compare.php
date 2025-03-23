<?php
session_start();
include 'config.php';

if (isset($_POST['maSanPham'])) {
    $maSanPham = $_POST['maSanPham'];

    // Lấy mã loại, tên sản phẩm, và hình ảnh của sản phẩm muốn thêm vào so sánh
    $query = "SELECT maLoai, tenSanPham, hinhAnh FROM san_pham WHERE maSanPham = :maSanPham";
    $stmt = $dbh->prepare($query);
    $stmt->execute([':maSanPham' => $maSanPham]);
    $sanPham = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($sanPham) {
        $maLoai = $sanPham['maLoai'];
        $tenSanPham = $sanPham['tenSanPham'];
        $hinhAnh = $sanPham['hinhAnh'];

        // Khởi tạo session nếu chưa tồn tại
        if (!isset($_SESSION['compare_products'])) {
            $_SESSION['compare_products'] = [];
        }

        // Kiểm tra loại sản phẩm đầu tiên trong danh sách so sánh (nếu danh sách không trống)
        if (!empty($_SESSION['compare_products'])) {
            $firstProductLoai = $_SESSION['compare_products'][0]['maLoai'];

            // Nếu loại sản phẩm mới khác loại sản phẩm trong danh sách, báo lỗi
            if ($maLoai !== $firstProductLoai) {
                echo json_encode(['success' => false, 'message' => 'Chỉ có thể so sánh các sản phẩm cùng loại!']);
                exit;
            }
        }

        // Chỉ thêm sản phẩm nếu nó chưa có trong danh sách so sánh
        if (!in_array($maSanPham, array_column($_SESSION['compare_products'], 'maSanPham'))) {
            $_SESSION['compare_products'][] = [
                'maSanPham' => $maSanPham,
                'tenSanPham' => $tenSanPham,
                'hinhAnh' => $hinhAnh,
                'maLoai' => $maLoai
            ];

            echo json_encode(['success' => true, 'tenSanPham' => $tenSanPham, 'hinhAnh' => $hinhAnh]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm đã có trong danh sách so sánh.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Mã sản phẩm không hợp lệ.']);
}
?>
