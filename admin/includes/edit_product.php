<?php
include 'config.php';

$product_id = $_GET['id']; // Giả định bạn truyền ID sản phẩm qua URL

// Lấy thông tin sản phẩm
$productQuery = $dbh->prepare("SELECT * FROM san_pham WHERE maSanPham = :product_id");
$productQuery->execute([':product_id' => $product_id]);
$product = $productQuery->fetch(PDO::FETCH_ASSOC);

// Lấy thông số kỹ thuật của sản phẩm
$specQuery = $dbh->prepare("SELECT * FROM thong_so_ky_thuat WHERE maSanPham = :product_id");
$specQuery->execute([':product_id' => $product_id]);
$technicalSpecs = $specQuery->fetchAll(PDO::FETCH_ASSOC);

// Chuyển đổi thông số kỹ thuật thành định dạng có thể sử dụng trong form
$loaiThongSoArray = [];
$tenThongSoArray = [];
$giaTriThongSoArray = [];

foreach ($technicalSpecs as $spec) {
    $loaiThongSoArray[] = $spec['loaiThongSo'];
    $tenThongSoArray[] = $spec['tenThongSo'];
    $giaTriThongSoArray[] = $spec['giaTriThongSo'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $product_id = $_POST["MASP"];
        $product_name = $_POST["TENSP"];
        $price_buy = $_POST["DONGIABAN"];
        if (empty($price_buy)) {
            $price_buy = 0;
        }
        $brand_id = $_POST["MATH"];
        $type_id = $_POST["MALOAI"];
        $description = $_POST["MOTA"];

        // Xử lý hình ảnh
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Lấy file hình
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            if ($file_size > 2097152) {
                $errors[] = 'File size should be 2MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, $_SESSION['rootPath'] . "/../assets/img/sanpham/" . $file_name);
                $statement = $dbh->prepare("UPDATE san_pham SET tenSanPham = :product_name, donGiaBan = :price_buy, maThuongHieu = :brand_id, maLoai = :type_id, hinhAnh = :file_name, moTa = :description WHERE maSanPham = :product_id");
                $statement->execute([
                    ':product_name' => $product_name,
                    ':price_buy' => $price_buy,
                    ':brand_id' => $brand_id,
                    ':type_id' => $type_id,
                    ':description' => $description,
                    ':product_id' => $product_id,
                    ':file_name' => $file_name // Chỉ truyền tên file nếu có
                ]);
            } else {
                print_r($errors);
            }
        } else {
            $statement = $dbh->prepare("UPDATE san_pham SET tenSanPham = :product_name, donGiaBan = :price_buy, maThuongHieu = :brand_id, maLoai = :type_id, moTa = :description WHERE maSanPham = :product_id");
            $statement->execute([
                ':product_name' => $product_name,
                ':price_buy' => $price_buy,
                ':brand_id' => $brand_id,
                ':type_id' => $type_id,
                ':description' => $description,
                ':product_id' => $product_id
            ]);
        }

        // Xử lý thông số kỹ thuật
        if (isset($_POST['loaiThongSo'])) {
            $loaiThongSoArray = $_POST['loaiThongSo'];
            $tenThongSoArray = $_POST['tenThongSo'];
            $giaTriThongSoArray = $_POST['giaTriThongSo'];

            // Xóa thông số kỹ thuật cũ liên quan đến sản phẩm này
            $deleteQuery = "DELETE FROM thong_so_ky_thuat WHERE maSanPham = :product_id";
            $deleteStatement = $dbh->prepare($deleteQuery);
            $deleteStatement->execute([':product_id' => $product_id]);

            // Thêm thông số kỹ thuật mới
            for ($i = 0; $i < count($loaiThongSoArray); $i++) {
                $loaiThongSo = $loaiThongSoArray[$i];
                $tenThongSoList = explode(',', $tenThongSoArray[$i]); // Tách tên thông số bằng dấu phẩy
                $giaTriList = explode(',', $giaTriThongSoArray[$i]); // Tách giá trị thông số bằng dấu phẩy

                foreach ($tenThongSoList as $key => $tenThongSo) {
                    $giaTriThongSo = isset($giaTriList[$key]) ? trim($giaTriList[$key]) : ''; // Lấy giá trị tương ứng

                    if (!empty($loaiThongSo) && !empty(trim($tenThongSo)) && !empty($giaTriThongSo)) {
                        $insertQuery = "INSERT INTO thong_so_ky_thuat (maSanPham, loaiThongSo, tenThongSo, giaTriThongSo) VALUES (:product_id, :loaiThongSo, :tenThongSo, :giaTriThongSo)";
                        $insertStatement = $dbh->prepare($insertQuery);
                        $insertStatement->execute([
                            ':product_id' => $product_id,
                            ':loaiThongSo' => $loaiThongSo,
                            ':tenThongSo' => trim($tenThongSo), // Trimming whitespace
                            ':giaTriThongSo' => $giaTriThongSo
                        ]);
                    }
                }
            }
        }

        echo '<script>
            alert("Cập nhật thông tin thành công");
            window.location.href = "../pages/product_index.php?";
        </script>';
    } catch (Exception $e) {
        echo 'Có lỗi trong quá trình cập nhật thông tin: ' . $e->getMessage();
    }
}
?>
