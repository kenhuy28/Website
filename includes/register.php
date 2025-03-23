<?php
include("config.php");

try {
    // Tạo mã khách hàng tự động tăng
    $maKhachHang = "KH";
    $query = "SELECT MAX(CAST(SUBSTRING(khach_hang.maKhachHang, 4) AS SIGNED)) AS max_id FROM khach_hang";
    $statement = $dbh->prepare($query);
    $statement->execute();
    $count = $statement->fetchColumn() + 1;
    $index = strval($count);
    $temp = array("", "0", "00", "000");
    $maKhachHang = $maKhachHang . $temp[4 - strlen($index)] . $index;

    // Các thông tin để tạo khách hàng
    $hoKhachHang = $_POST['hoKhachHang'];
    $tenKhachHang = $_POST['tenKhachHang'];
    $dienThoai = $_POST['dienThoai'];
    $diaChi = $_POST['diaChi'];
    $tendn = $_POST['tendn'];
    $matKhau = md5($_POST['matKhau']); // Nên dùng password_hash() cho bảo mật tốt hơn
    $email = $_POST['email'];
    $ngaySinh = $_POST['ngaySinh'];
    $maXa = ((isset($_POST["maXa"])) ? $_POST["maXa"] : "X00001");
    // Giá trị mặc định cho `diemTichLuy` là 0
    $diemTichLuy = 0;

    // Câu lệnh INSERT 
    $sql_themKhachHang = "INSERT INTO khach_hang (maKhachHang, hoKhachHang, tenKhachHang, dienThoai, diaChiCuThe, tenNguoiDung, matKhau, email, ngaySinh, avatar, khoiPhucMatKhau, maXa, diemTichLuy) 
                          VALUES ('$maKhachHang', '$hoKhachHang', '$tenKhachHang', '$dienThoai', '$diaChi', '$tendn', '$matKhau', '$email', '$ngaySinh', NULL, NULL, '$maXa', '$diemTichLuy');";
    $statement = $dbh->prepare($sql_themKhachHang);
    $statement->execute();

    // Điều hướng về trang login
    header("Location: ../pages/login.php");
} catch (PDOException $e) {
    // Xử lý ngoại lệ nếu có lỗi xảy ra
    echo "Lỗi: " . $e->getMessage();
}
?>
