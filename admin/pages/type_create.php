<?php include '../templates/nav_admin1.php' ?>


<div class="create_admin">
    <h1 class="Title_Admin_create_form">Thêm màu sắc</h1>
    <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
    <!-- @using (Html.BeginForm("Create", "Loai", FormMethod.Post, new { @enctype = "multipart/form-data", @id = "form-3", @class = "create_admin_form" }))
    {
        @Html.AntiForgeryToken() -->
    <form action="">
        <div class="form_field">
            <label for="" class="name_form_field">Mã loai : </label>
            <input type="text" class="textfile" readonly value="@MaLoai" name="MALOAI">
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên loại : </label>
            <input type="text" class="textfile" id="mausac" name="TENLOAI">
            <span class="error_message"></span>
        </div>
        <div class="button">
            <input type="button" value="Thêm" class="button_add_admin delete_display_alert" />
            <a href="@Url.Action(" Index","Loai")"><input type="button" value="Quay lại" class="button_add_admin" /></a>
        </div>
        <div class="alert_delete">
            <div class="notification">
                <h1 class="notification_title">Đã thêm màu sắc!</h1>
                <a href="@Url.Action(" Index","Loai")"><input type="submit" value="Ok"
                        class="alert_delete_btn delete_conform" /></a>
            </div>
        </div>
    </form>
</div>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mong muốn của chúng ta
        Validator({
            form: '#form-3',
            formGroupSelector: '.form_field',
            errorSelector: '.error_message',
            rules: [
                Validator.isRequired('#mausac', 'Vui lòng nhập tên màu sắc!'),
            ],
            onSubmit: function (data) {
                // Call API
                //console.log(data);
            }
        });
    });
    const load = document.querySelector.bind(document);
    const alert_delete_btn = load(".delete_display_alert");
    const alert_delete_conform_btn = load(".delete_conform");
    const alert_delete = load(".alert_delete");
    alert_delete_btn.onclick = () => {
        alert_delete.style.display = "block";
    };
</script> -->
<?php include '../templates/nav_admin2.php' ?>