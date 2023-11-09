<?php include '../templates/header.php'; ?>
<?php
class HocSinh
{
    private $ma;
    var $ho;
    var $ten;
    var $ngaysinh;
    var $diemtb;
    const HESO = 2;
    function setMa($maHS)
    {
        $this->ma = $maHS;
    }
    function getMa()
    {
        return $this->ma;
    }
    function getHoten()
    {
        return $this->ho . " " . $this->ten;
    }
    function getTuoi()
    {
        $ns = explode("/", $this->ngaysinh);
        return date("Y") - $ns[2];
    }
    function tinhDiem()
    {
        return $this->diemtb * self::HESO;
    }
}
$hs1 = new HocSinh();
$hs1->setMa("123");
$hs1->ho = "Ngô Tuấn";
$hs1->ten = "Lam";
$hs1->ngaysinh = "02/10/2002";
$hs1->diemtb = 7;
echo "<h1>THÔNG TIN ĐỐI TƯỢNG</h1>";
echo "<br>Họ tên: ", $hs1->getHoten();
echo "<br>Tuổi: {$hs1->getTuoi()}";
echo "<br>Mã: {$hs1->getMa()}";
echo "<br> Điểm đạt được là: {$hs1->tinhDiem()}";
echo "<br> Theo hệ số là: " . HocSinh::HESO;
?>
<?php include '../templates/footer.php' ?>