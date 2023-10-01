<?php include '../templates/nav_admin1.php' ?>
<style>
    input,
    select,
    textarea {
        font-size: 16px;
    }

    label {
        font-size: 20px;
    }
</style>
<div class="body" style="margin-top: 15px">
    <div class="create_admin">
        <h1 class="Title_Admin_create_form">Thêm thương hiệu</h1>
        <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
        <form active="" method="post">
            <div class="form_field">
                <label for="" class="name_form_field">Mã thương hiệu : </label>
                <input type="text" class="textfile" readonly value="@ViewBag.MaThuongHieu" name="MATH">
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Tên thương hiệu : </label>
                <input type="text" class="textfile" id="thuonghieu" name="TENTH">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Tình trạng hiển thị : </label>
                <div class="check_anhien">
                    <div class="show_anhien_radio">
                        <input type="radio" name="ANHIEN" value="True" checked class="check_anhien_radio">
                        <label>Hiển thị logo</label>
                    </div>
                    <div class="show_anhien_radio">
                        <input type="radio" name="ANHIEN" value="False" class="check_anhien_radio">
                        <label>Ẩn logo</label>
                    </div>
                </div>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Logo : </label>
                <div class="custom-file">
                    <div class="form_field">
                        <input type="file" class="custom-file-input" id="img_thuonghieu" name="fileUpload">
                        <span class="error_message"></span>
                    </div>
                    <div class="custom-file-img" style="width: 237px;">
                        <img src="https://webkit.org/demos/srcset/image-src.png" alt="Logo thương hiệu"
                            id="custom-file-img-display" style="width: 231px; ">
                    </div>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Thêm" class="button_add_admin" />
                <a href="trademark_index.php"><input type="button" value="Quay lại" class="button_add_admin" /></a>
            </div>
        </form>
    </div>
    <script>
        var dsUserName = @Html.Raw(Json.Encode(ViewBag.dsUserName));
        document.addEventListener('DOMContentLoaded', function () {
            // Mong muốn của chúng ta
            Validator({
                form: '#form-2',
                formGroupSelector: '.form_field',
                errorSelector: '.error_message',
                rules: [
                    Validator.isRequired('#thuonghieu', 'Vui lòng nhập tên thương hiệu!'),
                    Validator.isRequired('#img_thuonghieu', 'Vui lòng thêm ảnh đại điện!'),
                ],
                onSubmit: function (data) {
                    // Call API
                    //console.log(data);
                }
            });
        });
        const img_thuonghieu = document.querySelector("#img_thuonghieu");
        const custom_file_img_display = document.querySelector("#custom-file-img-display");
        img_thuonghieu.onchange = function (e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                custom_file_img_display.src = e.target.result;
            };
            reader.readAsDataURL(file);
        };
    </script>
</div>
<?php include '../templates/nav_admin2.php' ?>