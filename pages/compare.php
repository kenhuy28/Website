<?php
// compare.php
include '../templates/header.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kết nối đến cơ sở dữ liệu
require_once('../includes/config.php');

// Hàm lọc và xác thực ID sản phẩm
function getValidProductIds($ids) {
    $idArray = explode(',', $ids);
    $idArray = array_map('trim', $idArray);
    $idArray = array_filter($idArray, function($id) {
        return preg_match('/^SP\d+$/', $id);
    });
    return array_values($idArray);
}

// Lấy ID sản phẩm từ URL
$productIds = [];
if (isset($_GET['ids'])) {
    $productIds = getValidProductIds($_GET['ids']);
}

// Kiểm tra sản phẩm từ cơ sở dữ liệu
if (empty($productIds)) {
    $products = [];
} else {
    $placeholders = rtrim(str_repeat('?,', count($productIds)), ',');
    $sql = "
        SELECT sp.*, tskt.tenThongSo, tskt.giaTriThongSo 
        FROM san_pham sp 
        LEFT JOIN thong_so_ky_thuat tskt ON sp.maSanPham = tskt.maSanPham 
        WHERE sp.maSanPham IN ($placeholders)
    ";

    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute($productIds);
        $productData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nhóm thông số kỹ thuật theo sản phẩm
        $products = [];
        foreach ($productData as $row) {
            $maSanPham = $row['maSanPham'];
            if (!isset($products[$maSanPham])) {
                $products[$maSanPham] = [
                    'sanPham' => [
                        'tenSanPham' => $row['tenSanPham'],
                        'hinhAnh' => $row['hinhAnh'],
                        'donGiaBan' => $row['donGiaBan'],
                        'moTa' => $row['moTa']
                    ],
                    'thongSoKyThuat' => []
                ];
            }
            $products[$maSanPham]['thongSoKyThuat'][] = [
                'tenThongSo' => $row['tenThongSo'],
                'giaTriThongSo' => $row['giaTriThongSo']
            ];
        }

    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        $products = [];
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>So Sánh Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 15px;
            text-align: center;
            vertical-align: top;
        }
        th {
            background-color: #f4f4f4;
        }
        img {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>So Sánh Sản Phẩm</h1>
    <?php if (count($products) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Thông Tin</th>
                    <?php foreach ($products as $product): ?>
                        <th><?php echo htmlspecialchars($product['sanPham']['tenSanPham'], ENT_QUOTES, 'UTF-8'); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <!-- Hình Ảnh -->
                <tr>
                    <td>Hình Ảnh</td>
                    <?php foreach ($products as $product): ?>
                        <td>
                            <img src="<?php echo htmlspecialchars('../assets/img/sanpham/' . $product['sanPham']['hinhAnh'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['sanPham']['tenSanPham'], ENT_QUOTES, 'UTF-8'); ?>">
                        </td>
                    <?php endforeach; ?>
                </tr>
                <!-- Giá -->
                <tr>
                    <td>Giá</td>
                    <?php foreach ($products as $product): ?>
                        <td>
                            <?php echo number_format($product['sanPham']['donGiaBan'], 0, ',', '.'); ?> ₫
                        </td>
                    <?php endforeach; ?>
                </tr>
                <!-- Mô Tả -->
                <tr>
                    <td>Mô Tả</td>
                    <?php foreach ($products as $product): ?>
                        <td><?php echo nl2br(htmlspecialchars($product['sanPham']['moTa'], ENT_QUOTES, 'UTF-8')); ?></td>
                    <?php endforeach; ?>
                </tr>
                <!-- Thông số kỹ thuật -->
                <?php
                // Lấy danh sách thông số kỹ thuật duy nhất để hiển thị hàng
                $allSpecs = [];
                foreach ($products as $product) {
                    foreach ($product['thongSoKyThuat'] as $spec) {
                        if (!in_array($spec['tenThongSo'], $allSpecs)) {
                            $allSpecs[] = $spec['tenThongSo'];
                        }
                    }
                }

                // Hiển thị thông số kỹ thuật
                foreach ($allSpecs as $specName): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($specName, ENT_QUOTES, 'UTF-8'); ?></td>
                        <?php foreach ($products as $product): ?>
                            <?php 
                            $specValue = '';
                            foreach ($product['thongSoKyThuat'] as $spec) {
                                if ($spec['tenThongSo'] == $specName) {
                                    $specValue = $spec['giaTriThongSo'];
                                    break;
                                }
                            }
                            ?>
                            <td><?php echo htmlspecialchars($specValue, ENT_QUOTES, 'UTF-8'); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Không có sản phẩm để so sánh.</p>
    <?php endif; ?>
    <button onclick="window.history.back();">Quay lại</button>
</body>
</html>
