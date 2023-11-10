<?php include '../templates/header.php'; ?>

<head>
    <style>
        table {
            background: #ffd94d;
            border: 0 solid;
            background-color: #ffffcc;
        }

        h1 {
            text-align: center;
            margin: 5px;
        }

        #xuly {
            text-align: center;
        }
    </style>
</head>

<?php

class NhanVien
{
    public $hoTen;
    public $gioiTinh;
    public $ngayVaoLam;
    public $heSoLuong;
    public $soCon;
    const luongCoBan = 1000000;

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon)
    {
        $this->hoTen = $hoTen;
        $this->gioiTinh = $gioiTinh;
        $this->ngayVaoLam = $ngayVaoLam;
        $this->heSoLuong = $heSoLuong;
        $this->soCon = $soCon;
    }

    public function tinhLuongThuong()
    {
        // Số năm làm việc
        $soNamLamViec = date('Y') - date('Y', strtotime($this->ngayVaoLam));

        // Tính tiền thưởng
        return $soNamLamViec * 1000000;
    }
}

class NhanVienVanPhong extends NhanVien
{
    public $soNgayVang;
    const dinhMucVang = 5;
    const donGiaPhat = 200000;

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang)
    {
        parent::__construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon);
        $this->soNgayVang = $soNgayVang;
    }

    public function tinhTienPhat()
    {
        if ($this->soNgayVang > self::dinhMucVang) {
            return $this->soNgayVang * self::donGiaPhat;
        }

        return 0;
    }

    public function tinhTroCap()
    {
        if ($this->gioiTinh == 'nữ') {
            return 200000 * $this->soCon * 1.5;
        }

        return 200000 * $this->soCon;
    }

    public function tinhTienLuong()
    {
        return self::luongCoBan * $this->heSoLuong - $this->tinhTienPhat();
    }
}


class NhanVienSanXuat extends NhanVien
{
    public $soSanPham;
    const dinhMucSanPham = 100;
    const donGiaSanPham = 100.000;

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soSanPham)
    {
        parent::__construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon);
        $this->soSanPham = $soSanPham;
    }

    public function tinhTienThuong()
    {
        if ($this->soSanPham > self::dinhMucSanPham) {
            return ($this->soSanPham - self::dinhMucSanPham) * self::donGiaSanPham * 0.03;
        }

        return 0;
    }

    public function tinhTroCap()
    {
        return $this->soCon * 120000;
    }

    public function tinhTienLuong()
    {
        return ($this->soSanPham * self::donGiaSanPham) + $this->tinhTienThuong();
    }
}

$hoTen;
$soCon;
$ngaySinh;
$ngayLam;
$gioiTinh;
$radLNV;
$soNgayVang;
$heSo;
$soSanPham;

if (
    isset($_POST['submit'])
) {
    $hoTen = $_POST["hoTen"];
    $soCon = $_POST["soCon"];
    $ngaySinh = $_POST["ngaySinh"];
    $ngayLam = $_POST["ngayLam"];
    $gioiTinh = $_POST["gioiTinh"];
    $radLNV = $_POST["radLNV"];
    $soNgayVang = $_POST["soNgayVang"];
    $heSo = $_POST["heSo"];
    $soSanPham = $_POST["soSanPham"];

    $nv;
    if ($radLNV == "vanPhong") {
        $nv = new NhanVienVanPhong($hot, $gioiTinh, $ngayLam, $heSo, $soCon, $soNgayVang);
        $luong = $nv->tinhTienLuong();
        $troCap = $nv->tinhTroCap();
        $thuong = $nv->tinhLuongThuong();
        $phat = $nv->tinhTienPhat();
        $thucLinh = $luong + $troCap + $thuong - $phat;
    } else {
        $nv = new NhanVienSanXuat($hoTen, $gioiTinh, $ngayLam, $heSo, $soCon, $soSanPham);
    }
}

?>

<form method="post">
    <table>
        <thead>
            <tr>
                <td colspan="4">
                    <h1>
                        QUẢN LÝ NHÂN VIÊN
                    </h1>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Họ tên:</td>
                <td><input style="width: 250px;" type="text" name="hoTen" value="<?php if (!empty($hoTen))
                    echo $hoTen; ?>"></td>

                <td>Số con:</td>
                <td><input type="text" name="soCon" value="<?php if (isset($soCon))
                    echo $soCon; ?>"></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="date" name="ngaySinh" value="<?php if (!empty($ngaySinh))
                    echo $ngaySinh; ?>"></td>

                <td>Ngày vào làm:</td>
                <td><input type="date" name="ngayLam" value="<?php if (!empty($ngayLam))
                    echo $ngayLam; ?>"></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>
                    <input type="radio" name="gioiTinh" value="Nam" <?php if (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == 'Nam')
                        echo 'checked="checked"'; ?> checked> Nam
                    <input type="radio" name="gioiTinh" value="Nu" <?php if (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == 'Nu')
                        echo 'checked="checked"'; ?>> Nữ
                </td>

                <td>Hệ số lương:</td>
                <td>
                    <input type="number" name="heSo" value="<?php if (!empty($heSo))
                        echo $heSo; ?>">
                </td>
            </tr>
            <tr>
                <td>Loại nhân viên:</td>
                <td> <input type="radio" name="radLNV" value="vanPhong" <?php if (isset($_POST['radLNV']) && $_POST['radLNV'] == 'vanPhong')
                    echo 'checked="checked"'; ?> /> Văn phòng
                    <input style="width: unset;" type="radio" name="radLNV" value="sanXuat" <?php if (isset($_POST['radLNV']) && $_POST['radLNV'] == 'sanXuat')
                        echo 'checked="checked"'; ?> /> Sản
                    xuất
                </td>

            </tr>
            <tr>
                <td></td>
                <td>Số ngày vắng: <input style="width: 100px;" type="number" name="soNgayVang"></td>
                <td colspan="2">Số sản phẩm<input style="width: 100px;" type="number" name="soSanPham"></td>

            </tr>
            <tr>
                <td colspan="4" style="text-align: center;"><input type="submit" name="submit"
                        value="Tính lương"></input></td>
            </tr>

            <tr>
                <td>Tiền lương:</td>
                <td><input style="width: 250px;" type="text" value="<?php if (!empty($luong))
                    echo $luong; ?>"></td>

                <td>Trợ cấp:</td>
                <td><input type="number" value="<?php if (!empty($troCap))
                    echo $troCap; ?>"></td>
            </tr>
            <tr>
                <td>Tiền thưởng:</td>
                <td><input type="text" value="<?php if (!empty($thuong))
                    echo $thuong; ?>"></td>

                <td>Tiền phạt:</td>
                <td><input type="number" value="<?php if (!empty($phat))
                    echo $phat; ?>"></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">Thực tính: <input style="width: 100px;" type="number" value="<?php if (!empty($thucLinh))
                    echo $thucLinh; ?>"></td>
            </tr>
        </tbody>
    </table>

</form>
<?php include '../templates/footer.php' ?>