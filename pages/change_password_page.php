<!--change password-->
<?php include '../templates/header.php' ?>
<h6 style="margin-bottom: 40px">Trang chủ > Thay đổi mật khẩu </h6>
<div class="create_admin" style="margin-bottom: 300px">
    <h1 class="Title_Admin_create_form">Mật khẩu mới</h1>
    <p class="Notification_create_form">Vui lòng điền email để reset mật khẩu</p>
    <form action="" class="create_admin_form">
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
        <h6 style="color: forestgreen"></h6>
        <div class="form_field" style="display:none">

        </div>

        <div class="button">
            <input type="submit" value="Đặt lại mật khẩu" class="button_add_admin" style="width: 150px" />
        </div>
    </form>
</div>
<?php include '../templates/footer.php' ?>