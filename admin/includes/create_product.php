<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $maSanPham = $_POST["MASP"];
    $tenSanPham = $_POST["TENSP"];
    $donGiaMua = 0; // Bạn có thể thay đổi giá trị này nếu cần
    $donGiaBan = $_POST["DONGIABAN"];
    $maThuongHieu = $_POST["MATH"];
    $maLoai = $_POST["MALOAI"];
    $soLuong = 0; // Bạn có thể thay đổi giá trị này nếu cần
    $desciption = $_POST["MOTA"];

    // Kiểm tra và xử lý file hình ảnh sản phẩm
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        // Kiểm tra kích thước file (giới hạn 2MB)
        if ($file_size > 2097152) {
            $errors[] = 'File size should not exceed 2MB';
        }
        if (empty($errors)) {
            move_uploaded_file($file_tmp, $_SESSION['rootPath'] . "/../assets/img/sanpham/" . $file_name);
            // Thêm sản phẩm vào bảng `san_pham`
            $query = "INSERT INTO san_pham (maSanPham, tenSanPham, donGiaMua, donGiaBan, maThuongHieu, maLoai, soLuong, hinhAnh, moTa) 
                      VALUES (:maSanPham, :tenSanPham, :donGiaMua, :donGiaBan, :maThuongHieu, :maLoai, :soLuong, :hinhAnh, :moTa)";
            $statement = $dbh->prepare($query);
            $statement->bindParam(':maSanPham', $maSanPham);
            $statement->bindParam(':tenSanPham', $tenSanPham);
            $statement->bindParam(':donGiaMua', $donGiaMua);
            $statement->bindParam(':donGiaBan', $donGiaBan);
            $statement->bindParam(':maThuongHieu', $maThuongHieu);
            $statement->bindParam(':maLoai', $maLoai);
            $statement->bindParam(':soLuong', $soLuong);
            $statement->bindParam(':hinhAnh', $file_name);
            $statement->bindParam(':moTa', $desciption);

            if ($statement->execute()) {
                // Nếu lưu sản phẩm thành công, tiếp tục lưu các thông số kỹ thuật
                if (isset($_POST['loaiThongSo']) && isset($_POST['tenThongSo']) && isset($_POST['giaTriThongSo'])) {
                    $loaiThongSoArray = $_POST['loaiThongSo'];
                    $tenThongSoArray = $_POST['tenThongSo'];
                    $giaTriThongSoArray = $_POST['giaTriThongSo'];

                    for ($i = 0; $i < count($loaiThongSoArray); $i++) {
                        $loaiThongSo = $loaiThongSoArray[$i];
                        $tenThongSoList = explode(',', $tenThongSoArray[$i]); // Tách tên thông số bằng dấu phẩy
                        $giaTriList = explode(',', $giaTriThongSoArray[$i]); // Tách giá trị thông số bằng dấu phẩy

                        foreach ($tenThongSoList as $key => $tenThongSo) {
                            $giaTriThongSo = isset($giaTriList[$key]) ? trim($giaTriList[$key]) : ''; // Lấy giá trị tương ứng

                            $sqlThongSo = "INSERT INTO thong_so_ky_thuat (maSanPham, loaiThongSo, tenThongSo, giaTriThongSo)
                                           VALUES(:maSanPham, :loaiThongSo, :tenThongSo, :giaTriThongSo)";
                            $stmtThongSo = $dbh->prepare($sqlThongSo);
                            $stmtThongSo->bindParam(':maSanPham', $maSanPham);
                            $stmtThongSo->bindParam(':loaiThongSo', $loaiThongSo);
                            $stmtThongSo->bindParam(':tenThongSo', trim($tenThongSo)); // Trimming whitespace
                            $stmtThongSo->bindParam(':giaTriThongSo', $giaTriThongSo);

                            if (!$stmtThongSo->execute()) {
                                echo "<script>alert('Có lỗi xảy ra khi thêm thông số kỹ thuật');</script>";
                            }
                        }
                    }
                }

                echo "<script>alert('Thêm sản phẩm và thông số kỹ thuật thành công');</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra khi thêm sản phẩm');</script>";
            }
        } else {
            print_r($errors);
        }
        
    } else {
        echo "<script>alert('Có lỗi xảy ra khi tải lên hình ảnh');</script>";
    }
    echo '<script>window.location.href = "javascript:history.go(-2);";</script>';

}
?>
