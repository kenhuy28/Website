<!--register-->

<?php include '../templates/header.php' ?>
<h6>Trang chủ > Đăng ký </h6>
<div class="create_admin">
    <h1 class="Title_Admin_create_form">Tạo tài khoản </h1>
    <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
    <form class="create_admin_form">
        <div class="form_field">
            <label for="" class="name_form_field">Họ tên: </label>
            <input type="text" class="textfile" id="fullname" name="HOTENKH" style="width: 400px;">
            <span class="error_message"></span>
        </div>

        <div class="form_field">
            <label for="" class="name_form_field">Số điện thoại : </label>
            <input type="text" class="textfile" id="phoneNumber" name="DIENTHOAI" style="width: 400px;">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Email : </label>
            <input type="text" class="textfile" id="email" name="EMAIL" style="width: 400px;">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Ngày sinh : </label>
            <input type="date" class="textfile" id="birthDay" name="NGAYSINH" style="width: 400px;">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên đăng nhập : </label>
            <input type="text" class="textfile" id="userName" name="TENDNKH" style="width: 400px;">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Mật khẩu : </label>
            <input type="password" class="textfile" id="password" name="MATKHAUKH" style="width: 400px;">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Xác nhận lại mật khẩu : </label>
            <input type="password" class="textfile" id="password_confirmation" style="width: 400px;">
            <span class="error_message"></span>
        </div>
        <div style="display: flex; justify-content: space-between; width: 400px;">
            <div class="form_field">
                <label for="" class="name_form_field">Tỉnh : </label>
                <select class="textfile" name="MATINH" style="width: 195px;" id="Tinh">
                    <option value="">Chọn tỉnh/Thành phố</option>
                    <option value="@item.MATINH"></option>
                </select>
                <span class="error_message"></span>
            </div>

            <div class="form_field">
                <label for="" class="name_form_field">Huyện : </label>
                <select class="textfile" name="MAHUYEN" style="width: 195px;" id="Huyen" disabled>

                    <option value="">Chọn huyện</option>
                </select>
                <span class="error_message"></span>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between; width: 400px;">
            <div class="form_field">
                <label for="" class="name_form_field">Xã : </label>
                <select class="textfile" name="MAXA" style="width: 195px;" id="Xa" disabled>
                    <option value="">Chọn xã</option>
                </select>
                <span class="error_message"></span>
            </div>

            <div class="form_field">
                <label for="" class="name_form_field">Số nhà và tên đường : </label>
                <input type="text" class="textfile" style="width: 195px;" id="address" name="DAICHI">
                <span class="error_message"></span>
            </div>
        </div>

        <div class="form_field" style="max-width: 400px">
            <label for="" class="name_form_field">Ảnh đại diện : </label>
            <div class="custom-file">
                <div class="form_field">
                    <input type="file" class="custom-file-input" id="img_profile_admin" name="fileUpload"
                        style="max-width: 300px;">
                    <span class="error_message"></span>
                </div>
                <div class="custom-file-img">
                    <img src="" alt="" id="custom-file-img-display">
                </div>
            </div>
        </div>
        <div class="button">
            <input type="submit" value="Đăng ký" class="button_add_admin" />
        </div>
    </form>
</div>
<?php include '../templates/footer.php' ?>