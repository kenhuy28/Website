<?php 
    include("config.php");
    $maSanPham = $_POST['maSanPham'];
    $nguoiDung = $_POST['nguoiDung'];
    $query = "SELECT * FROM gio_hang WHERE maSanPham = '$maSanPham' AND maKhachHang = '$nguoiDung'";
    $statement = $dbh->prepare($query);
    $success = $statement->execute();
    $sanPham= $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($statement->rowCount() > 0) {
        $query = "UPDATE gio_hang SET soLuong = soLuong + 1 WHERE maSanPham ='$maSanPham' and maKhachHang = '$nguoiDung'";
        $statement = $dbh->prepare($query);
        $success = $statement->execute();
    } 
    else {
        $query = "INSERT INTO gio_hang(maKhachHang, maSanPham, soLuong)
        VALUES ('$nguoiDung', '$maSanPham', 1)";
        $statement = $dbh->prepare($query);
        $success = $statement->execute();
    }
    $response = array('success' => $success);
    echo json_encode($response);
?>