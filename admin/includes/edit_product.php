<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $product_id = $_POST["MASP"];
        $product_name = $_POST["TENSP"];
        $price_buy = $_POST["DONGIABAN"];
        $brand_id = $_POST["MATH"];
        $type_id = $_POST["MALOAI"];
        $desciption = $_POST["MOTA"];
        echo $desciption;
        echo $_POST[$_FILES['image']];
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            //lấy file hình
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            if ($file_size > 2097152) {
                $errors[] = 'File size should be 2MB';
            }
            echo $fileName;
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, $_SESSION['rootPath'] . "/../assets/img/sanpham/" . $file_name);
            } else {
                print_r($errors);
            }

            $statement = $dbh->prepare("UPDATE san_pham SET tenSanPham = '" . $product_name . "', donGiaBan = " . $price_buy . ", maThuongHieu = '" . $brand_id . "', maLoai = '" . $type_id . "', hinhAnh = '" . $file_name . "', moTa = '" . $desciption . "' WHERE maSanPham = '" . $product_id . "'");
            $statement->execute();

        } else {
            $statement = $dbh->prepare("UPDATE san_pham SET tenSanPham = '" . $product_name . "', donGiaBan = " . $price_buy . ", maThuongHieu = '" . $brand_id . "', maLoai = '" . $type_id . "', moTa = '" . $desciption . "' WHERE maSanPham = '" . $product_id . "'");
            $statement->execute();
        }
        //     echo '<script>
        //     alert("Cập nhật thông tin thành công");
        //     window.location.href = "../pages/product_index.php?";
        // </script>';
    } catch (Exception $e) {
        echo 'Có lỗi trong quá trình cập nhật thông tin' . $e->getMessage();
    }
}
?>