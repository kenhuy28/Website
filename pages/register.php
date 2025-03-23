<?php
include '../templates/header.php';
$get_tinh = "SELECT `maTinh`, `tenTinh` FROM `tinh`";
$statement = $dbh->prepare($get_tinh);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);

?>

<div class="Smember"> 
    <img src="../assets/img/logo/Smember.png" alt="Logo Smember" class="centered-image">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    // Kiểm tra mật khẩu có ít nhất 8 ký tự, bao gồm cả chữ và số
    function validatePassword(password) {
        var regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        return regex.test(password);
    }

    $('#password').on('input', function () {
        var passwordValue = $(this).val();
        var errorMessage = '';

        if (!validatePassword(passwordValue)) {
            errorMessage = 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm cả chữ và số.';
        }

        $(this).siblings('.error_message').text(errorMessage);
        validatePasswordMatch();
    });

    $('#confirmPassword').on('input', function () {
        validatePasswordMatch();
    });

    // Kiểm tra tính trùng khớp của mật khẩu và mật khẩu xác nhận
    function validatePasswordMatch() {
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        var errorMessage = '';

        if (password !== confirmPassword) {
            errorMessage = 'Mật khẩu không khớp.';
        }

        $('#confirmPasswordError').text(errorMessage);
        updateRegisterButtonState();
    }

 // Kiểm tra email phải có định dạng @gmail.com
    function validateEmail(email) {
        var regex = /^[A-Za-z0-9._%+-]+@gmail\.com$/;
        return regex.test(email);
    }

    $('#email').on('input', function () {
        var emailValue = $(this).val();
        var errorMessage = '';

        if (!validateEmail(emailValue)) {
            errorMessage = 'Email phải có định dạng @gmail.com.';
        }

        $(this).siblings('.error_message').text(errorMessage);
        updateRegisterButtonState();
    });

    function updateRegisterButtonState() {
        var passwordError = $('#password').siblings('.error_message').text();
        var confirmPasswordError = $('#confirmPasswordError').text();
        var emailError = $('#email').siblings('.error_message').text();
        var userNameMessage = $('#userName_message').text();

        $('#registerButton').prop('disabled', passwordError != "" || confirmPasswordError != "" || emailError != "" || userNameMessage != "");
    }
    // Kiểm tra số điện thoại
    function validatePhoneNumber(phone) {
            var regex = /^0\d{9}$/; // Đầu số là 0 và có 9 số tiếp theo
            return regex.test(phone);
        }

        $('#phoneNumber').on('input', function () {
            var phoneValue = $(this).val();
            var errorMessage = '';

            if (!validatePhoneNumber(phoneValue)) {
                errorMessage = 'Số điện thoại phải bắt đầu bằng 0 và có đúng 10 số.';
            }

            $(this).siblings('.error_message').text(errorMessage);
            updateRegisterButtonState();
        });
        function getDistricts(selectedProvince) {
            jQuery.ajax({
                url: '../includes/get_register.php',
                type: 'POST',
                data: { province_id: selectedProvince },
                success: function (data) {
                    $('#districts').html(data);
                    $('#wards').html('<option value="">Chọn Xã</option>');
                    $('#maXaInput').val('');
                }
            });
        }
        function getWards(selectedDistrict) {
            jQuery.ajax({
                url: '../includes/get_register.php',
                type: 'POST',
                data: { district_id: selectedDistrict },
                success: function (data) {
                    $('#wards').html(data);
                    var selectedWard = $('#wards').val();
                    $('#maXaInput').val(selectedWard);
                }
            });
        }
        $('#provinces').change(function () {
            var selectedProvince = $(this).val();
            getDistricts(selectedProvince);
        });
        $('#districts').change(function () {
            var selectedDistrict = $(this).val();
            getWards(selectedDistrict);
        });
        $('#wards').change(function () {
            // Cập nhật giá trị của #maXaInput khi bạn thay đổi xã.
            var selectedWard = $(this).val();
            $('#maXaInput').val(selectedWard);
        });

        function getUsername(userName) {
            jQuery.ajax({
                url: '../includes/get_register.php',
                type: 'POST',
                data: { userName: userName },
                success: function (data) {
                    $('#userName_message').html(data);
                    updateRegisterButtonState();
                }
            });
        }
        function updateRegisterButtonState() {
            var userNameMessage = $('#userName_message').text();
            // Kiểm tra nếu tên đăng nhập đã tồn tại thì không cho bấm đăng ký
            $('#registerButton').prop('disabled', userNameMessage != "");
        }

        $('#userName').on('input', function () {
            var userNameValue = $(this).val();
            userNameValue = userNameValue.replace(/[^A-Za-z0-9_]/g, '');
            $(this).val(userNameValue);

            // Cập nhật thông tin từ server khi người dùng nhập liệu
            getUsername(userNameValue);
        });
    });
</script>

<div class="create_admin">
<div style="text-align: center;">
    <h1 class="Title_Admin_create_form">Tạo tài khoản</h1>
    <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
</div>

    <form class="create_admin_form" action="../includes/register.php" method="POST">
        <div class="form_field">
            <label for="" class="name_form_field">Họ </label>
            <input type="text" class="textfile" name="hoKhachHang" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên </label>
            <input type="text" class="textfile" name="tenKhachHang" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Số điện thoại </label>
            <input type="text" class="textfile" id="phoneNumber" name="dienThoai" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Email </label>
            <input type="text" class="textfile" id="email" name="email" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Ngày sinh </label>
            <input type="date" class="textfile" id="birthDay" name="ngaySinh" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên đăng nhập </label>
            <input type="text" class="textfile" id="userName" name="tendn" style="width: 400px;" required>
            <span class="error_message" id="userName_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Mật khẩu </label>
            <input type="password" class="textfile" id="password" name="matKhau" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>

        <div class="form_field">
            <label for="" class="name_form_field">Nhập lại mật khẩu </label>
            <input type="password" class="textfile" id="confirmPassword" style="width: 400px;" required>
            <span class="error_message" id="confirmPasswordError"></span>
        </div>

        <div style="display: flex; flex-direction: column; align-items: center; width: 400px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; width: 100%;">
        <div class="form_field">
            <label for="" class="name_form_field">Tỉnh </label>
            <select id='provinces' class="textfile" name="provinces" style="width: 195px;">
                <option value="" disabled selected>Chọn tỉnh/Thành phố</option>
                <?php
                while ($row = $statement->fetch())
                    echo "<option value='{$row->maTinh}'>{$row->tenTinh}</option>";
                ?>
            </select>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Huyện </label>
            <select id='districts' class="textfile" name="districts" style="width: 195px;">
                <option disabled selected value="">Chọn Huyện</option>
            </select>
            <span class="error_message"></span>
        </div>
    </div>
    <div style="display: flex; justify-content: space-between; width: 100%;">
        <div class="form_field">
            <label for="" class="name_form_field">Xã </label>
            <select required id="wards" class="textfile" style="width: 195px;">
                <option value="">Chọn Xã</option>
            </select>
            <input hidden type="text" name="maXa" id="maXaInput">
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Địa chỉ cụ thể</label>
            <input type="text" class="textfile" id="diaChi" name="diaChi" style="width: 195px;" required>
        </div>
    </div>
</div>


        <!-- <div class="form_field" style="max-width: 400px">
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
        </div> -->
        <div class="button">
            <input disabled type="submit" name="submit" id="registerButton" value="Đăng ký" class="button_add_admin" />
        </div>
    </form>
</div>
<?php include '../templates/footer.php' ?>
<style>
.Smember {
    display: flex;
    justify-content: center; /* Căn giữa hình ảnh theo chiều ngang */
    align-items: center; /* Căn giữa hình ảnh theo chiều dọc nếu cần */
}

.centered-image {
    max-width: 10%; /* Giảm kích thước tối đa của hình ảnh (bạn có thể điều chỉnh theo ý muốn) */
    height: auto; /* Giữ tỉ lệ khung hình cho hình ảnh */
}
</style>