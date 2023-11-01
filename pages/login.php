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
<form action="" class="create_admin_form">
    <div class="form_field">
        <label for="taikhoan" class="name_form_field">Tài khoản : </label>
        <input type="text" class="textfile" name="tendn" id="taikhoan" value="<?php if ($username != "")
                echo $username; ?>" >
        <span class="error_message"></span>
    </div>
    <div class="form_field">
        <label for="matkhau" class="name_form_field">Mật khẩu : </label>
        <input type="password" class="textfile" id="matkhau" name="matkhau" value="<?php if ($password != "")
                echo $password; ?>">
        <span class="error_message">
        </span>
    </div>
    <div class="form_field" style="min-height: 10px">
        <span class="error_message" style="font-weight: bold;">
            <?php if ($warning != "")
                echo $warning; ?>
        </span>
    </div>
    <input type="submit" value="Đăng Nhập" class="button_add_admin" style="width: 150px" />
    <a href="" class="qmk" style="display: block; margin-left: 10px; color: black">Quên
        mật khẩu?</a>
    <a href="./register.php" style="text-decoration: none; color:black">
        <input type="button" value="Tạo Tài Khoản" class="button_add_admin" style="width: 150px; margin-bottom: 50px" />
    </a>
</form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mong muốn của chúng ta
        Validator({
            form: '#form-2',
            formGroupSelector: '.form_field',
            errorSelector: '.error_message',
            rules: [
                Validator.isRequired('#taikhoan', 'Vui lòng nhập tài khoản!'),
                Validator.isRequired('#matkhau', 'Vui lòng nhập mật khẩu!'),
            ],
            onSubmit: function (data) {
                // Call API
                console.log(data);
            }
        });
    });
</script>
<?php include '../templates/footer.php' ?>