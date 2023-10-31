<!--login-->
<?php include '../templates/header.php' ?>
<div class="login_flex_right_title">
    <h6>Đăng Nhập</h6>
</div>
<form action="login.php" class="create_admin_form" id="form-2">
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
    <input type="submit" value="Đăng Nhập" class="button_add_admin" style="width: 150px" />
    <a href="" class="qmk" style="display: block; margin-left: 10px; color: black">Quên
        mật khẩu?</a>
    <a href="" style="text-decoration: none; color:black">
        <input type="button" value="Tạo Tài Khoản" class="button_add_admin" style="width: 150px; margin-bottom: 50px" />
    </a>
</form>
</div>
<script src="../assets/js/app.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mong muốn của chúng ta
            Validator({
                form: '#form-2',
                formGroupSelector: '.form_field',
                errorSelector: '.error_message',
                rules: [
                    Validator.isRequired('#taikhoan', 'Vui lòng nhập tên thương hiệu!'),
                ],
                onSubmit: function (data) {
                    // Call API
                    //console.log(data);
                }
            });
        });
    </script>
<?php include '../templates/footer.php' ?>