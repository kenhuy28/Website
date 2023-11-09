<?php include '../templates/header.php'; ?>
<?php
class HinhHoc
{
    public function Ve()
    {
        echo "Vẽ Hinh";
    }
    public function tinhDT()
    {
        echo "Tính diện tích: ";
    }
}
class HinhVuong extends HinhHoc
{
    public $canh = 0;
    public function Ve()
    {
        echo "Vẽ hình vuông: ";
    }
    public function tinhDT()
    {
        return $this->canh * $this->canh;
    }
}
class HinhChuNhat extends HinhHoc
{
    public $dai = 0;
    public $rong = 0;
    public function Ve()
    {
        echo "Vẽ hình chữ nhật";
    }
    public function tinhDT()
    {
        return $this->dai * $this->rong;
    }
}
echo "CÁC HÌNH TẠO TỪ ĐỐI TƯỢNG <br><br>";
$HinhChuNhat = new HinhChuNhat();
$HinhChuNhat->Ve();
$HinhChuNhat->dai = 30;
$HinhChuNhat->rong = 25;
echo "<br>Chiều dài" . $HinhChuNhat->dai;
echo "<br>Chiều rộng" . $HinhChuNhat->rong;
echo "<br> Diện tích hình chữ nhật là: {$HinhChuNhat->tinhDT()}<br>";
$HinhVuong = new HinhVuong();
$HinhVuong->Ve();
$HinhVuong->canh = 20;
echo "<br>Chiều dài cạnh" . $HinhVuong->canh;
echo "<br> Diện tích hình vuông là: {$HinhVuong->tinhDT()}";
?>

<?php include '../templates/footer.php' ?>