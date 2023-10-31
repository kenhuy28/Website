<?php
include '../templates/nav_admin1.php';
include '../includes/get_product_data_from_id.php';

?>
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
<div class="body" style="margin-top: 10px">
    <div class="create_admin">
        <label class="Title_Admin_create_form">Thêm sản phẩm</label>
        <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>

        <form action="" method="post">
            <div>
                <label for="" class="name_form_field">Mã sản phẩm: </label>
                <input type="text" class="textfile" readonly value="<?php echo $result->maSanPham ?>" name="MASP">
            </div>
            <div>
                <label for="" class="name_form_field">Tên sản phẩm: </label>
                <input type="text" class="textfile" id="fullname" name="TENSP"
                    value="<?php echo $result->tenSanPham ?>">
                <span class="error_message"></span>
            </div>
            <div>
                <label for="" class="name_form_field">Đơn giá bán: </label>
                <input type="number" class="textfile" id="giaban" name="DONGIABAN"
                    value="<?php echo $result->donGiaBan; ?>" name="donGiaBan">
                <span class="error_message"></span>
            </div>

            <div>
                <label for="" class="name_form_field">Thương hiệu: </label>
                <select class="textfile" name="MATH" id="thuonghieu">

                    <?php include '../includes/show_brand_in_option.php' ?>
                </select>
                <span class="error_message"></span>
            </div>
            <div>
                <label for="" class="name_form_field">Loại: </label>
                <select class="textfile" name="MALOAI">
                    <?php include '../includes/show_type_in_option.php' ?>

                </select>
                <span class="error_message"></span>
            </div>
            <div>
                <label for="" class="name_form_field">Mô tả: </label>
                <textarea class="textfile_address" cols="2" id="address"
                    name="MOTA"><?php echo $result->moTa ?></textarea>
                <span class="error_message"></span>
            </div>
            <div>
                <label for="" class="name_form_field">Ảnh đại diện: </label>
                <div class="custom-file">
                    <div>
                        <input type="file" class="custom-file-input" id="img_profile_admin" name="fileUpload" value="">
                        <span class="error_message"></span>
                    </div>
                    <div class="custom-file-img">
                        <img src="<?php echo $_SESSION['rootPath'] . '/../assets/img/sanpham/' . $result->hinhAnh ?>"
                            alt="" id="custom-file-img-display">
                    </div>
                </div>
            </div>

            <div class="button">
                <input type="submit" value="Cập nhật" class="button_add_admin" />
                <a href="javascript:history.go(-1);"><input type="button" value="Quay lại"
                        class="button_add_admin" /></a>
            </div>

        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mong muốn của chúng ta
            Validator({
                form: '#form-1',
                formGroupSelector: '.form_field',
                errorSelector: '.error_message',
                rules: [
                    Validator.isRequired('#fullname', 'Vui lòng nhập tên sản phẩm!'),
                    Validator.isRequired('#giamua', 'Vui lòng nhập giá mua!'),
                    Validator.isRequired('#giaban', 'Vui lòng nhập giá bán!'),
                    Validator.isRequired('#soluong', 'Vui lòng nhập số lượng!'),
                    Validator.isLessZero('#giamua', 'Vui lòng nhập giá mua lớn hơn hoặc bằng không'),
                    Validator.isLessZero('#giaban', 'Vui lòng nhập giá bán lớn hơn hoặc bằng không'),
                    Validator.isLessZero('#soluong', 'Vui lòng nhập số lượng lớn hơn không'),
                    Validator.isRong('#thuonghieu', 'Vui lòng chọn thương hiệu')
                ],
                onSubmit: function (data) {
                    // Call API
                    //console.log(data);
                }
            });
        });
    </script>
</div>
<?php include '../templates/nav_admin2.php' ?>