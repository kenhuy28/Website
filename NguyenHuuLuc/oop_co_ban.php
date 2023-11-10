<?php
include '../templates/header.php'; ?>

<?php
class Person
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

    public function getHoTen()
    {
        return $this->hoTen;
    }

    public function setHoTen($hoTen)
    {
        $this->hoTen = $hoTen;
    }

    public function getDiaChi()
    {
        return $this->diaChi;
    }

    public function setDiaChi($diaChi)
    {
        $this->diaChi = $diaChi;
    }

    public function getGioiTinh()
    {
        return $this->gioiTinh;
    }

    public function setGioiTinh($gioiTinh)
    {
        $this->gioiTinh = $gioiTinh;
    }
}

class SinhVien extends Person
{
    protected $lopHoc;
    protected $nganhHoc;

    public function __construct($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc)
    {
        parent::__construct($hoTen, $diaChi, $gioiTinh);
        $this->lopHoc = $lopHoc;
        $this->nganhHoc = $nganhHoc;
    }

    public function getLopHoc()
    {
        return $this->lopHoc;
    }

    public function setLopHoc($lopHoc)
    {
        $this->lopHoc = $lopHoc;
    }

    public function getNganhHoc()
    {
        return $this->nganhHoc;
    }

    public function setNganhHoc($nganhHoc)
    {
        $this->nganhHoc = $nganhHoc;
    }

    public function tinhDiemThuong()
    {
        switch ($this->nganhHoc) {
            case "CNTT":
                return 1;
            case "Kinh tế":
                return 1.5;
            default:
                return 0;
        }
    }
}

class GiangVien extends Person
{
    protected $trinhDo;
    const luongCoBan = 1500000;

    public function __construct($hoTen, $diaChi, $gioiTinh, $trinhDo)
    {
        parent::__construct($hoTen, $diaChi, $gioiTinh);
        $this->trinhDo = $trinhDo;
    }

    public function getTrinhDo()
    {
        return $this->trinhDo;
    }

    public function setTrinhDo($trinhDo)
    {
        $this->trinhDo = $trinhDo;
    }

    public function tinhLuong()
    {
        switch ($this->trinhDo) {
            case "Cử nhân":
                return self::luongCoBan * 2.34;
            case "Thạc sĩ":
                return self::luongCoBan * 3.67;
            case "Tiến sĩ":
                return self::luongCoBan * 5.66;
            default:
                return 0;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nhập thông tin GV/SV</title>
</head>

<body>
    <form action="" method="post">
        <label for="hoTen">Họ tên: </label>
        <input type="text" name="hoTen" id="hoTen">
        <br>
        <label for="diaChi">Địa chỉ: </label>
        <input type="text" name="diaChi" id="diaChi">
        <br>
        <label for="gioiTinh">Giới tính: </label>
        <input type="radio" name="gioiTinh" id="nam" value="Nam"> Nam
        <input type="radio" name="gioiTinh" id="nu" value="Nữ"> Nữ
        <br>
        <label for="lopHoc">Lớp học (nếu là SV): </label>
        <input type="text" name="lopHoc" id="lopHoc">
        <br>
        <label for="nganhHoc">Ngành học (nếu là SV): </label>
        <input type="text" name="nganhHoc" id="nganhHoc">
        <br>
        <label for="trinhDo">Trình độ (nếu là GV): </label>
        <select name="trinhDo" id="trinhDo">
            <option value="Cử nhân">Cử nhân</option>
            <option value="Thạc sĩ">Thạc sĩ</option>
            <option value="Tiến sĩ">Tiến sĩ</option>
        </select>
        <br>
        <input type="submit" name="submit" value="Tính">
    </form>

    <?php
    if (isset($_POST["submit"])) {
        $hoTen = $_POST['hoTen'];
        $diaChi = $_POST['diaChi'];
        $gioiTinh = $_POST['gioiTinh'];

        if ($gioiTinh == 'Nam') {
            $gioiTinh = 'Nam';
        } else {
            $gioiTinh = 'Nữ';
        }

        if ($_POST['lopHoc'] != '') {
            $lopHoc = $_POST['lopHoc'];
            $nganhHoc = $_POST['nganhHoc'];

            $sinhVien = new SinhVien($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc);

            $diemThuong = $sinhVien->tinhDiemThuong();

            echo "<h2>Thông tin sinh viên</h2>";
            echo "<ul>";
            echo "<li>Họ tên: $hoTen</li>";
            echo "<li>Địa chỉ: $diaChi</li>";
            echo "<li>Giới tính: $gioiTinh</li>";
            echo "<li>Lớp học: $lopHoc</li>";
            echo "<li>Ngành học: $nganhHoc</li>";
            echo "<li>Điểm thưởng: $diemThuong</li>";
            echo "</ul>";
        } else {
            $trinhDo = $_POST['trinhDo'];

            $giangVien = new GiangVien($hoTen, $diaChi, $gioiTinh, $trinhDo);

            $luong = $giangVien->tinhLuong();

            echo "<h2>Thông tin giảng viên</h2>";
            echo "<ul>";
            echo "<li>Họ tên: $hoTen</li>";
            echo "<li>Địa chỉ: $diaChi</li>";
            echo "<li>Giới tính: $gioiTinh</li>";
            echo "<li>Trình độ: $trinhDo</li>";
            echo "<li>Lương: $luong</li>";
            echo "</ul>";
        }
    }
    ?>
    <button type="button" onclick="window.history.go(-1);">Quay lại</button>
</body>

</html>


<?php include '../templates/footer.php' ?>