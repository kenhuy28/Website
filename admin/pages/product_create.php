<?php
include '../templates/nav_admin1.php';
include '../includes/get_new_product_id.php';
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
<div class="body" style="margin-top: 15px">
    <div class="create_admin">
        <h1 class="Title_Admin_create_form">Thêm sản phẩm</h1>
        <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
        <form action="../includes/create_product.php" method="post" id="form" enctype="multipart/form-data">
            <div class="form_field">
                <label for="" class="name_form_field">Mã sản phẩm : </label>
                <input type="text" class="textfile" readonly value="<?php echo $maSanPham ?>" name="MASP">
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Tên sản phẩm : </label>
                <input required type="text" class="textfile" id="fullname" name="TENSP">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Đơn giá bán : </label>
                <input required type="number" class="textfile" id="giaban" name="DONGIABAN">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Thương hiệu : </label>
                <select required class="textfile" name="MATH" id="thuonghieu">
                    <option disabled selected value="">Chọn thương hiệu</option>
                    <?php include '../includes/show_brand_in_option.php' ?>
                </select>
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Loại : </label>
                <select required class="textfile" name="MALOAI" id="loai">
                    <option disabled selected value="">Chọn loại</option>
                    <?php include '../includes/show_type_in_option.php' ?>
                </select>
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Mô tả : </label>
                <textarea class="textfile_address" form="form" cols="2" id="address" name="MOTA"></textarea>
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Ảnh sản phẩm : </label>
                <div class="custom-file">
                    <div>
                        <input type="file" class="custom-file-input" id="img_product" name="image" accept="image/*">
                        <span class="error_message"></span>
                    </div>
                    <div class="custom-file-img">
                        <img src="https://webkit.org/demos/srcset/image-src.png" alt="" id="custom-file-img-display">
                    </div>
                </div>
            </div>

<h2>Thông số kỹ thuật</h2>
<div id="technical_specs">
    <div class="form_field">
        <label for="" class="name_form_field">Loại thông số : </label>
        <input required type="text" class="textfile" id="loaiThongSo" name="loaiThongSo[]">
        <span class="error_message"></span>
    </div>
    <div class="form_field">
        <label for="" class="name_form_field">Tên thông số (phân cách bằng dấu phẩy): </label>
        <input required type="text" class="textfile" id="tenThongSo" name="tenThongSo[]">
        <span class="error_message"></span>
    </div>
    <div class="form_field">
        <label for="" class="name_form_field">Giá trị thông số (phân cách bằng dấu phẩy): </label>
        <textarea required class="textfile_address" id="giaTriThongSo" name="giaTriThongSo[]"></textarea>
        <span class="error_message"></span>
    </div>
</div>
<!-- <button type="button" onclick="addTechnicalSpec()">Thêm thông số kỹ thuật khác</button> -->
            <div class="button">
            <input type="button" value="Thêm thông số kỹ thuật" class="button_add_admin" onclick="addTechnicalSpec()" />
                <input type="submit" value="Thêm" class="button_add_admin" />
                <a href="product_index.php"><input type="button" value="Quay lại"
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
            Validator.isRequired('#img_profile_admin', 'Vui lòng chọn hình sản phẩm!'),
            Validator.isLessZero('#giamua', 'Vui lòng nhập giá mua lớn hơn hoặc bằng không'),
            Validator.isLessZero('#giaban', 'Vui lòng nhập giá bán lớn hơn hoặc bằng không'),
            Validator.isRong('#thuonghieu', 'Vui lòng chọn thương hiệu'),
            Validator.isRong('#loai', 'Vui lòng chọn loại sản phẩm'),
            // Thêm quy tắc cho các thông số kỹ thuật
            {
                selector: 'input[name="loaiThongSo[]"]',
                test: function (value) {
                    return value.trim() !== '' || 'Vui lòng nhập loại thông số!';
                }
            },
            {
                selector: 'input[name="tenThongSo[]"]',
                test: function (value) {
                    return value.trim() !== '' || 'Vui lòng nhập tên thông số!';
                }
            },
            {
                selector: 'textarea[name="giaTriThongSo[]"]',
                test: function (value) {
                    return value.trim() !== '' || 'Vui lòng nhập giá trị thông số!';
                }
            }
        ],
        onSubmit: function (data) {
            // Call API
        }
    });
});

const img_thuonghieu = document.querySelector("#img_product");
const custom_file_img_display = document.querySelector("#custom-file-img-display");
img_thuonghieu.onchange = function (e) {
    const file = e.target.files[0];
    const reader = new FileReader();
    reader.onload = (e) => {
        custom_file_img_display.src = e.target.result;
    };
    reader.readAsDataURL(file);
};

function addTechnicalSpec() {
    const technicalSpecDiv = document.createElement('div');
    technicalSpecDiv.innerHTML = `
        <div class="form_field">
            <label for="" class="name_form_field">Loại thông số : </label>
            <input required type="text" class="textfile" name="loaiThongSo[]">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên thông số : </label>
            <input required type="text" class="textfile" name="tenThongSo[]">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Giá trị thông số : </label>
            <textarea required class="textfile_address" name="giaTriThongSo[]"></textarea>
            <span class="error_message"></span>
        </div>
    `;
    document.getElementById('technical_specs').appendChild(technicalSpecDiv);
}
</script>
</div>
<?php include '../templates/nav_admin2.php'; ?>