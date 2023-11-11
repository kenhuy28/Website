<?php
include '../templates/header.php';
?>

<?php

function TinhUCLN($a, $b)
{
    if ($b == 0)
        return $a;
    return TinhUCLN($b, $a % $b);
}

class PhanSo
{
    private $tu;
    private $mau;

    public function __construct($tu, $mau)
    {
        $this->tu = $tu;
        $this->mau = $mau;
    }
    public function get_tu()
    {
        return $this->tu;
    }
    public function get_mau()
    {
        return $this->mau;
    }

    public function RutGonPhanSo()
    {
        $UCLN = TinhUCLN($this->tu, $this->mau);
        $this->tu /= $UCLN;
        $this->mau /= $UCLN;
    }

    public function CongPhanSo(PhanSo $ps)
    {
        $tuMoi = $this->tu * $ps->get_mau() + $ps->get_tu() * $this->mau;
        $mauMoi = $this->mau * $ps->get_mau();
        $psMoi = new PhanSo($tuMoi, $mauMoi);
        $psMoi->RutGonPhanSo();
        return $psMoi;
    }

    public function TruPhanSo(PhanSo $ps)
    {
        $tuMoi = $this->tu * $ps->get_mau() - $ps->get_tu() * $this->mau;
        $mauMoi = $this->mau * $ps->get_mau();
        $psMoi = new PhanSo($tuMoi, $mauMoi);
        $psMoi->RutGonPhanSo();
        return $psMoi;
    }

    public function NhanPhanSo(PhanSo $ps)
    {
        $tuMoi = $this->tu * $ps->get_tu();
        $mauMoi = $ps->get_mau() * $this->mau;
        $psMoi = new PhanSo($tuMoi, $mauMoi);
        $psMoi->RutGonPhanSo();
        return $psMoi;
    }

    public function ChiaPhanSo(PhanSo $ps)
    {
        $tuMoi = $this->tu * $ps->get_mau();
        $mauMoi = $this->mau * $ps->get_tu();
        $psMoi = new PhanSo($tuMoi, $mauMoi);
        $psMoi->RutGonPhanSo();
        return $psMoi;
    }
}

if (isset($_POST["tinh"])) {
    $ps1 = new PhanSo($_POST["a"], $_POST['b']);
    $ps2 = new PhanSo($_POST['c'], $_POST['d']);
    $pt = $_POST["PT"];
    if ($pt == "+") {
        $ps = $ps1->CongPhanSo($ps2);
        $kq = "Phép cộng là: " . $ps1->get_tu() . "/" . $ps1->get_mau() . " + " . $ps2->get_tu() . "/" . $ps2->get_mau() . " = " . $ps->get_tu() . "/" . $ps->get_mau();
    } else if ($pt == "-") {
        $ps = $ps1->TruPhanSo($ps2);
        $kq = "Phép cộng là: " . $ps1->get_tu() . "/" . $ps1->get_mau() . " - " . $ps2->get_tu() . "/" . $ps2->get_mau() . " = " . $ps->get_tu() . "/" . $ps->get_mau();
    } else if ($pt == "*") {
        $ps = $ps1->NhanPhanSo($ps2);
        $kq = "Phép cộng là: " . $ps1->get_tu() . "/" . $ps1->get_mau() . " * " . $ps2->get_tu() . "/" . $ps2->get_mau() . " = " . $ps->get_tu() . "/" . $ps->get_mau();

    } else {
        $ps = $ps1->ChiaPhanSo($ps2);
        $kq = "Phép cộng là: " . $ps1->get_tu() . "/" . $ps1->get_mau() . " / " . $ps2->get_tu() . "/" . $ps2->get_mau() . " = " . $ps->get_tu() . "/" . $ps->get_mau();
    }
}
?>

<form align='center' action="" method="post">
    <table>
        <tr>
            <td style="color: #6e448b">
                Chọn các phép tính trên phân số
            </td>
        </tr>
        <tr>
            <td>Nhập phân số thứ 1:</td>
            <td>Tử số:</td>
            <td><input colspan="1" type="text" name="a" value="<?php if (!empty($a))
                echo $a; ?>" /></td>
            <td>Mấu số:</td>
            <td><input colspan="1" type="text" name="b" value="<?php if (!empty($b))
                echo $b; ?>" /></td>
        </tr>
        <tr>
            <td>Nhập phân số thứ 2:</td>
            <td>Tử số:</td>
            <td><input colspan="1" type="text" name="c" value="<?php if (!empty($c))
                echo $c; ?>" /></td>
            <td>Mấu số:</td>
            <td><input colspan="1" type="text" name="d" value="<?php if (!empty($d))
                echo $d; ?>" /></td>
        </tr>
        <tr>
            <td colspan="5">
                <fieldset>
                    <legend>Chọn phép tính</legend>
                    <input colspan="1" type="radio" value="+" name="PT" <?php
                    if (isset($_POST["PT"]) && $_POST["PT"] == "+")
                        echo "checked"; ?> checked /> <label for="">Cộng</label>
                    <input colspan="1" type="radio" value="-" name="PT" <?php
                    if (isset($_POST["PT"]) && $_POST["PT"] == "-")
                        echo "checked"; ?> /> <label>Trừ</label>
                    <input colspan="1" type="radio" value="*" name="PT" <?php
                    if (isset($_POST["PT"]) && $_POST["PT"] == "*")
                        echo "checked"; ?> /> <label>Nhân</label>
                    <input colspan="1" type="radio" value="/" name="PT" <?php
                    if (isset($_POST["PT"]) && $_POST["PT"] == "/")
                        echo "checked"; ?> /> <label>Chia</label>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td align="left"><input type="submit" value="Tính" name="tinh" />
        </tr>
        <tr>
            <td>
                <?php if (!empty($kq))
                    echo $kq; ?>
            </td>
        </tr>
    </table>
</form>
<button type="button" onclick="window.history.go(-1);">Quay lại</button>
<?php include '../templates/footer.php' ?>