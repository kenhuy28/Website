<!--login-->
<?php include '../templates/header.php';
$conn = mysqli_connect('localhost', 'root', '', 'qlpkthucung');
mysqli_set_charset($conn, 'UTF8');
$sql = "SELECT *
        FROM khach_hang
        ";
$rerult = mysqli_query($conn, $sql);

if (isset($_POST["dangNhap"])) {
    $check = 1;
    if ($_POST['tendn'] == NULL) {
        echo 'Vui lòng nhập tài khoản <br>';
        $check = 2;
    } else {
        $username = $_POST['tendn'];
    }
    if ($_POST['matkhau'] == NULL) {
        echo 'Vui lòng nhập mật khẩu';
        $check = 2;
    } else {
        $password = $_POST['matkhau'];
    }

    while ($row = mysqli_fetch_array($rerult)) {
        if ($_POST['tendn'] == $row[5] && $_POST['matkhau'] == $row[6]) {
            echo '<script>window.location.href = "../index.php?";</script>';
            $_SESSION['maKhachHang'] = $row[0];
            $check = 2;
        }
    }
    if ($check == 1) {
        echo 'Thông tin không chính xác. Vui lòng đăng nhập lại';
    }
}


?>

<div class="login_flex_right_title">
    <h6>Đăng Nhập</h6>
</div>
<form action="" method="POST" class="create_admin_form">
    <div class="form_field">
        <label for="" class="name_form_field">Tài khoản : </label>
        <input type="text" class="textfile" name="tendn" id="taikhoan">
        <span class="error_message"></span>
    </div>
    <div class="form_field">
        <label for="" class="name_form_field">Mật khẩu : </label>
        <input type="password" class="textfile" id="matkhau" name="matkhau">
        <span class="error_message"></span>
    </div>
    <input type="submit" name="dangNhap" value="Đăng Nhập" class="button_add_admin" style="width: 150px" />
    <a href="" class="qmk" style="display: block; margin-left: 10px; color: black">Quên
        mật khẩu?</a>
    <a href="./register.php" style="text-decoration: none; color:black">
        <input type="button" value="Tạo Tài Khoản" class="button_add_admin" style="width: 150px; margin-bottom: 50px" />
    </a>
</form>
</div>
<?php include '../templates/footer.php' ?>