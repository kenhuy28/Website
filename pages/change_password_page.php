<!--change password-->
<?php include '../templates/header.php';
require_once('../includes/config.php');

$warning = "";
if (isset($_POST['NewPassword'])) {
    $password = md5(trim($_POST['NewPassword']));
} else {
    $password = "";
}
$ma = $_GET['ma'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE khach_hang SET matKhau = '$password' WHERE khoiPhucMatKhau = '$ma'";
    $stmt = $dbh->query($sql);
    $sql = "UPDATE khach_hang SET khoiPhucMatKhau = '' WHERE khoiPhucMatKhau = '$ma'";
    $stmt = $dbh->query($sql);
    $warning = "Đổi mật khẩu thành công";
}
?>

<h6 style="margin-bottom: 40px">Trang chủ > Thay đổi mật khẩu </h6>
<div class="create_admin" style="margin-bottom: 300px">
    <!-- <h1 class="Title_Admin_create_form">Mật khẩu mới</h1> -->
    <!-- <p class="Notification_create_form">Vui lòng điền email để reset mật khẩu</p> -->
    <form action="" class="create_admin_form" method="post"
        id='form-6'>
        <div class="form_field">
            <label for="" class="name_form_field">Nhập mật khẩu mới: </label>
            <input type="password" class="textfile" id="password" name="NewPassword" style="width: 400px;">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Xác nhận mật khẩu mới: </label>
            <input type="password" class="textfile" id="password_confirmation" name="ConfirmPassword"
                style="width: 400px;">
            <span class="error_message"></span>
        </div>
        <h6 style="color: forestgreen"><?php echo $warning;?></h6>
        <div class="button">
            <input id="datLaiPass" type="submit" value="Đổi mật khẩu" class="button_add_admin" style="width: 150px" />
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mong muốn của chúng ta
        Validator({
            form: '#form-6',
            formGroupSelector: '.form_field',
            errorSelector: '.error_message',
            rules: [
                Validator.isRequired('#password', 'Vui lòng nhập mật khẩu!'),
                Validator.isConfirmed('#password_confirmation', function () {
                    return document.querySelector('#form-6 #password').value;
                }, 'Mật khẩu nhập lại không chính xác'),
            ],
            onSubmit: function (data) {
                // Call API
                //console.log(data);
            }
        });
    });
</script>

<?php include '../templates/footer.php' ?>