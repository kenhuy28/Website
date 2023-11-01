<!--register-->

<?php
include '../templates/header.php';
$conn = mysqli_connect('localhost', 'root', '', 'qlpkthucung');
mysqli_set_charset($conn, 'UTF8');

$maKhachHanh = "KH";
$query = "SELECT COUNT(*) FROM `phieu_nhap`";
$statement = $dbh->prepare($query);
$statement->execute();
// Sử dụng fetchColumn
$count = $statement->fetchColumn() + 2;
if ($count <= 9) {
    $maKhachHanh .= "000" . $count;
} else if ($count <= 99) {
    $maKhachHanh .= "00" . $count;
} else if ($count <= 999) {
    $maKhachHanh .= "0" . $count;
} else {
    $maKhachHanh .= "" . $count;
}
if (!empty($_POST['hoKhachHang'])) {
    $hoKhachHang = $_POST['hoKhachHang'];
} else
    $hoKhachHang = "";
if (!empty($_POST['tenKhachHang'])) {
    $tenKhachHang = $_POST['tenKhachHang'];
} else
    $tenKhachHang = "";
if (!empty($_POST['dienThoai'])) {
    $dienThoai = $_POST['dienThoai'];
} else
    $dienThoai = "";
if (!empty($_POST['diaChi'])) {
    $diaChi = $_POST['diaChi'];
} else
    $diaChi = "";
if (!empty($_POST['tendn'])) {
    $tendn = $_POST['tendn'];
} else
    $tendn = "";
if (!empty($_POST['matKhau'])) {
    $matKhau = $_POST['matKhau'];
} else
    $matKhau = "";
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
} else
    $email = "";
if (!empty($_POST['ngaySinh'])) {
    $ngaySinh = $_POST['ngaySinh'];
} else
    $ngaySinh = "";
$fileUpLoad = "123.jpg";
$khoiPhuc = "123456";
$maXa = "X00011";
if (isset($_POST["submit"])) {

    $sql_themKhachHang = "INSERT INTO khach_hang VALUES ('$maKhachHanh','$hoKhachHang','$tenKhachHang','$dienThoai','$diaChi','$tendn','$matKhau','$email','$ngaySinh','$fileUpLoad','$khoiPhuc','$maXa');";
    $rerult_themKhachHang = mysqli_query($conn, $sql_themKhachHang);
}
?>

<h6>Trang chủ > Đăng ký </h6>
<script>
    fetch('https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1')
        .then(response => response.json())
        .then(data => {
            let provinces = data.data.data;
            provinces.map(value => document.getElementById('provinces').innerHTML += `<option value='${value.code}'>${value.name}</option>`);
        })
        .catch(error => {
            console.error('Lỗi khi gọi API:', error);
        });

    function fetchDistricts(provincesID) {
        fetch(`https://vn-public-apis.fpo.vn/districts/getByProvince?provinceCode=${provincesID}&limit=-1`)
            .then(response => response.json())
            .then(data => {
                let districts = data.data.data;
                if (districts !== undefined) {
                    districts.map(value => document.getElementById('districts').innerHTML += `<option value='${value.code}'>${value.name}</option>`);
                }
            })
            .catch(error => {
                console.error('Lỗi khi gọi API:', error);
            });
    }

    function fetchWards(districtsID) {
        fetch(`https://vn-public-apis.fpo.vn/wards/getByDistrict?districtCode=${districtsID}&limit=-1`)
            .then(response => response.json())
            .then(data => {
                let wards = data.data.data;
                if (wards !== undefined) {
                    wards.map(value => document.getElementById('wards').innerHTML += `<option value='${value.code}'>${value.name}</option>`);
                }
            })
            .catch(error => {
                console.error('Lỗi khi gọi API:', error);
            });
    }

    function getProvinces(event) {
        fetchDistricts(event.target.value);
    }

    function getDistricts(event) {
        fetchWards(event.target.value);
    }

</script>
<div class="create_admin">
    <h1 class="Title_Admin_create_form">Tạo tài khoản </h1>
    <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
    <form class="create_admin_form" method="POST">
        <div class="form_field">
            <label for="" class="name_form_field">Họ khách hàng: </label>
            <input type="text" class="textfile" name="hoKhachHang" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên khách hàng: </label>
            <input type="text" class="textfile" name="tenKhachHang" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Số điện thoại : </label>
            <input type="text" class="textfile" id="phoneNumber" name="dienThoai" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Email : </label>
            <input type="text" class="textfile" id="email" name="email" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Ngày sinh : </label>
            <input type="date" class="textfile" id="birthDay" name="ngaySinh" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Tên đăng nhập : </label>
            <input type="text" class="textfile" id="userName" name="tendn" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div class="form_field">
            <label for="" class="name_form_field">Mật khẩu : </label>
            <input type="password" class="textfile" id="password" name="matKhau" style="width: 400px;" required>
            <span class="error_message"></span>
        </div>
        <div style="display: flex; justify-content: space-between; width: 400px;">
            <div class="form_field">
                <label for="" class="name_form_field">Tỉnh : </label>
                <select id='provinces' onchange='getProvinces(event)' class="textfile" name="tinh" style="width: 195px;"
                    required>
                    <option value="">Chọn tỉnh/Thành phố</option>

                </select>
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Huyện : </label>
                <select id='districts' onchange='getDistricts(event)' class="textfile" name="huyen"
                    style="width: 195px;" id="Huyen">
                    <option value="">Chọn Huyện</option>
                </select>
                <span class="error_message"></span>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between; width: 400px;">
            <div class="form_field">
                <label for="" class="name_form_field">Xã : </label>
                <select id="wards" class="textfile" name="MAXA" style="width: 195px;" id="Xa">
                    <option value="">Chọn Xã</option>
                </select>
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Số nhà : </label>
                <input type="diaChi" class="textfile" id="diaChi" name="diaChi" style="width: 195px;" required>
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
            <input type="submit" name="submit" value="Đăng ký" class="button_add_admin" />
        </div>
    </form>
</div>
<?php include '../templates/footer.php' ?>