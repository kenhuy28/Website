<?php
include '../templates/nav_admin1.php';
include '../includes/get_product_data_from_id.php';
include '../includes/get_technical_specs_from_product_id.php'; // Bao gồm để lấy thông số kỹ thuật cho sản phẩm
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
        <label class="Title_Admin_create_form">Sửa thông tin sản phẩm</label>
        <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>

        <form action="../includes/edit_product.php" method="post" enctype="multipart/form-data" id="form-1">
            <div>
                <label for="" class="name_form_field">Mã sản phẩm: </label>
                <input type="text" class="textfile" readonly value="<?php echo $result->maSanPham ?>" name="MASP">
            </div>
            <div>
                <label for="" class="name_form_field">Tên sản phẩm: </label>
                <input required type="text" class="textfile" id="fullname" name="TENSP"
                    value="<?php echo $result->tenSanPham ?>">
                <span class="error_message"></span>
            </div>
            <div>
                <label for="" class="name_form_field">Đơn giá bán: </label>
                <input required type="number" class="textfile" id="giaban" name="DONGIABAN"
                    value="<?php echo $result->donGiaBan; ?>" name="donGiaBan">
                <span class="error_message"></span>
            </div>

            <div>
                <label for="" class="name_form_field">Thương hiệu: </label>
                <select required class="textfile" name="MATH" id="thuonghieu">
                    <?php include '../includes/show_brand_in_option.php' ?>
                </select>
                <span class="error_message"></span>
            </div>
            <div>
                <label for="" class="name_form_field">Loại: </label>
                <select required class="textfile" name="MALOAI">
                    <?php include '../includes/show_type_in_option.php' ?>
                    
                </select>
                <span class="error_message"></span>
            </div>
            <div style="margin-bottom: 10px;">
                <label for="" class="name_form_field">Mô tả: </label>
                <textarea class="" form="form-1" cols="60" id="address" rows="4"
                    name="MOTA"><?php echo $result->moTa ?></textarea>
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label class="name_form_field">Ảnh sản phẩm: </label>
                <div class="custom-file">
                    <div class="form_field">
                        <input type="file" class="custom-file-input" id="img_product" name="image" accept="image/*">
                        <span class="error_message"></span>
                    </div>
                    <div class="custom-file-img">
                        <img src="<?php echo $_SESSION['rootPath'] . "/../assets/img/sanpham/" . $result->hinhAnh; ?>"
                            alt="Logo sản phẩm" id="custom-file-img-display">
                    </div>
                </div>
            </div>

            <!-- Thông số kỹ thuật -->
            <div id="technical_specs">
    <?php
    // Kiểm tra xem có thông số kỹ thuật nào không
    if ($technicalSpecs) {
        foreach ($technicalSpecs as $spec) {
            ?>
            <div class="form_field">
                <label for="" class="name_form_field">Loại thông số:</label>
                <input required type="text" class="textfile" name="loaiThongSo[]"
                       value="<?php echo htmlspecialchars($spec['loaiThongSo']); ?>">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Tên thông số (cách nhau bởi dấu phẩy):</label>
                <input required type="text" class="textfile" name="tenThongSo[]"
                       value="<?php echo htmlspecialchars($spec['tenThongSo']); ?>">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Giá trị thông số (cách nhau bởi dấu phẩy):</label>
                <textarea required class="textfile_address" name="giaTriThongSo[]"><?php echo htmlspecialchars($spec['giaTriThongSo']); ?></textarea>
                <span class="error_message"></span>
            </div>
            <?php
        }
    } else {
        // Nếu không có thông số kỹ thuật nào, hiển thị trường trống
        ?>
        <div class="form_field">
            <label for="" class="name_form_field">Loại thông số:</label>
            <input required type="text" class="textfile" name="loaiThongSo[]">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên thông số (cách nhau bởi dấu phẩy):</label>
            <input required type="text" class="textfile" name="tenThongSo[]">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Giá trị thông số (cách nhau bởi dấu phẩy):</label>
            <textarea required class="textfile_address" name="giaTriThongSo[]"></textarea>
            <span class="error_message"></span>
        </div>
        <?php
    }
    ?>
</div>
<!-- <button type="button" onclick="addTechnicalSpec()">Thêm thông số kỹ thuật</button> -->
            <div class="button">
            <input type="button" value="Thêm thông số kỹ thuật" class="button_add_admin" onclick="addTechnicalSpec()" />
                <input type="submit" value="Cập nhật" class="button_add_admin" />
                <a href="javascript:history.go(-1);"><input type="button" value="Quay lại"
                        class="button_add_admin" /></a>
            </div>
        </form>
    </div>
    <script>
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
            <label for="" class="name_form_field">Loại thông số:</label>
            <input required type="text" class="textfile" name="loaiThongSo[]">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên thông số (cách nhau bởi dấu phẩy):</label>
            <input required type="text" class="textfile" name="tenThongSo[]">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Giá trị thông số (cách nhau bởi dấu phẩy):</label>
            <textarea required class="textfile_address" name="giaTriThongSo[]"></textarea>
            <span class="error_message"></span>
        </div>
    `;
    document.getElementById('technical_specs').appendChild(technicalSpecDiv);
}
    </script>
</div>
<?php include '../templates/nav_admin2.php' ?>