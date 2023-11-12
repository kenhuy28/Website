<?php include("../templates/header.php") ?>
<?php
class Nguoi
{
  protected $hoTen;
  protected $diaChi;
  protected $gioiTinh;

  public function __construct($hoTen, $diaChi, $gioiTinh)
  {
    $this->hoTen = $hoTen;
    $this->diaChi = $diaChi;
    $this->gioiTinh = $gioiTinh;
  }

  public function hienThiThongTin()
  {
    echo "Họ tên: $this->hoTen<br><br>";
    echo "Địa chỉ: $this->diaChi<br><br>";
    echo "Giới tính: $this->gioiTinh<br><br>";
  }
}

class SinhVien extends Nguoi
{
  protected $lopHoc;
  protected $nganhHoc;

  public function __construct($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc)
  {
    parent::__construct($hoTen, $diaChi, $gioiTinh);
    $this->lopHoc = $lopHoc;
    $this->nganhHoc = $nganhHoc;
  }

  public function tinhDiemThuong()
  {
    switch ($this->nganhHoc) {
      case 'CNTT':
        return 1;
      case 'Kinh te':
        return 1.5;
      case 'Dien tu':
        return 1;
      default:
        return 0;
    }
  }
}

class GiangVien extends Nguoi
{
  protected $trinhDo;
  const LUONG_CO_BAN = 1500000;

  public function __construct($hoTen, $diaChi, $gioiTinh, $trinhDo)
  {
    parent::__construct($hoTen, $diaChi, $gioiTinh);
    $this->trinhDo = $trinhDo;
  }

  public function tinhLuong()
  {
    switch ($this->trinhDo) {
      case 'Cu nhan':
        return self::LUONG_CO_BAN * 2.34;
      case 'Thac si':
        return self::LUONG_CO_BAN * 3.67;
      case 'Tien si':
        return self::LUONG_CO_BAN * 5.66;
      default:
        return 0;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $hoTen = $_POST['hoTen'];
  $diaChi = $_POST['diaChi'];
  $gioiTinh = $_POST['gioiTinh'];
  if ($_POST['loaiNguoi'] === 'sinhVien') {
    $lopHoc = $_POST['lopHoc'];
    $nganhHoc = $_POST['nganhHoc'];
    $sinhVien = new SinhVien($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc);
    $sinhVien->hienThiThongTin();
    echo "Điểm thưởng: " . $sinhVien->tinhDiemThuong();
  } elseif ($_POST['loaiNguoi'] === 'giangVien') {
    $trinhDo = $_POST['trinhDo'];
    $giangVien = new GiangVien($hoTen, $diaChi, $gioiTinh, $trinhDo);
    $giangVien->hienThiThongTin();
    echo "Lương: " . $giangVien->tinhLuong();
  }
}
?>

<h1>Nhập thông tin</h1>

<form method="post" action="" style="font-size: 20px;">
  <label for="hoTen">Họ tên:</label>
  <input type="text" name="hoTen" required style="height: 25px; border-radius: 6px; font-size: 15px;"><br>
  <br>
  <label for="diaChi">Địa chỉ:</label>
  <input type="text" name="diaChi" required style="height: 25px; border-radius: 6px; font-size: 15px;"><br>
  <br>

  <label for="gioiTinh">Giới tính:</label>
  <select name="gioiTinh" required style="height: 25px; border-radius: 6px; font-size: 15px;">
    <option value="Nam">Nam</option>
    <option value="Nu">Nữ</option>
  </select><br>
  <br>

  <label for="loaiNguoi">Loại người:</label>
  <select name="loaiNguoi" required style="height: 25px; border-radius: 6px; font-size: 15px;">
    <option value="sinhVien">Sinh viên</option>
    <option value="giangVien">Giảng viên</option>
  </select><br>
  <br>

  <div id="sinhVienFields">
    <label for="lopHoc">Lớp học (Sinh viên):</label>
    <input type="text" name="lopHoc"  style="height: 25px; border-radius: 6px; font-size: 15px;"><br>
    <br>

    <label for="nganhHoc">Ngành học (Sinh viên):</label>
    <select name="nganhHoc" style="height: 25px; border-radius: 6px; font-size: 15px;">
      <option value="CNTT">CNTT</option>
      <option value="Kinh te">Kinh tế</option>
      <option value="Dien tu">Điện tử</option>
    </select><br>
  </div>
  <br>

  <div id="giangVienFields" style="display: none;">
    <label for="trinhDo">Trình độ (Giảng viên):</label>
    <select name="trinhDo"  style="height: 25px; border-radius: 6px; font-size: 15px;">
      <option value="Cu nhan">Cử nhân</option>
      <option value="Thac si">Thạc sĩ</option>
      <option value="Tien si">Tiến sĩ</option>
    </select><br>
  </div>
  <br>

  <button type="submit"  style="height: 25px; border-radius: 6px; font-size: 15px;">Xác nhận</button>
</form>

<script>
  // Ẩn/Hiện các trường dựa vào loại người
  document.addEventListener('DOMContentLoaded', function () {
    var loaiNguoiSelect = document.querySelector('[name="loaiNguoi"]');
    var sinhVienFields = document.getElementById('sinhVienFields');
    var giangVienFields = document.getElementById('giangVienFields');

    loaiNguoiSelect.addEventListener('change', function () {
      if (loaiNguoiSelect.value === 'sinhVien') {
        sinhVienFields.style.display = 'block';
        giangVienFields.style.display = 'none';
      } else if (loaiNguoiSelect.value === 'giangVien') {
        sinhVienFields.style.display = 'none';
        giangVienFields.style.display = 'block';
      } else {
        sinhVienFields.style.display = 'none';
        giangVienFields.style.display = 'none';
      }
    });
  });
</script>
<br>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>