<?php include '../templates/nav_admin1.php' ?>



<div class="create_admin">
    <h1 class="Title_Admin_create_form">Chỉnh sửa thương hiệu</h1>
    <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
    <!-- @using (Html.BeginForm("Edit", "Loai", FormMethod.Post, new { @enctype = "multipart/form-data", @id = "form-2",
    @class = "create_admin_form" }))
    {
    @Html.AntiForgeryToken() -->
    <form action="">
        <div class="form_field">
            <label for="" class="name_form_field">Mã màu sắc : </label>
            <input type="text" class="textfile" readonly value="@MALOAI" name="MALOAI">
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên màu sắc : </label>
            <input type="text" class="textfile" id="mausac" value="@TENLOAI" name="TENLOAI">
            <span class="error_message"></span>
        </div>
        <div class="button">
            <input type="button" value="Chỉnh sửa" class="button_add_admin delete_display_alert" />
            <a href="@Url.Action(" Index","Loai")"><input type="button" value="Quay lại" class="button_add_admin" /></a>
        </div>
    </form>
</div>

<?php include '../templates/nav_admin2.php' ?>