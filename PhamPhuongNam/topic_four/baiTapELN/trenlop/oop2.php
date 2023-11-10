<?php
// Lớp Hình Học 
class HinhHoc
{
    public function Ve() // Hàm Vẽ Hình 
    {
        echo "Vẽ hình";
    }
    public function tinh_Dien_Tich() // Hàm Tính Diện Tích Của Hình 
    {
        echo 'Tính diện tích';
    }
}
// Lớp hình Vuông
class HinhVuong extends HinhHoc
{
    public $canh = 0; // Độ Dài Cạnh
    public function Ve()
    { // Định Nghĩa Lại Hàm Về Hình Vuông
        echo "Vẽ Hình Vuông";
    }
    public function tinh_Dien_Tich()
    { // Định Nghĩa Lại Hàm Tính Diện Tích
        return $this->canh * $this->canh;
    }
}
// Lớp hình chữ nhật
class HinhChuNhat extends HinhHoc
{
    public $dai = 0; // Chiều Dài Và Chiều Rộng 
    public $rong = 0;
    public function Ve()
    { // Định Nghĩa Lại Hàm Về Hình Chữ Nhật
        echo "Vẽ Hình Chữ Nhật";
    }
    public function tinh_Dien_Tich()
    { // Định Nghĩa Lại Hàm Tính Diện Tích 
        return $this->dai * $this->rong;
    }
} // Hình Chữ Nhật
$HinhChuNhat = new HinhChuNhat();
$HinhChuNhat->Ve();
$HinhChuNhat->dai = 25;
$HinhChuNhat->rong = 20;
echo "<br>Diện tích hình chữ nhật: " . $HinhChuNhat->tinh_Dien_Tich() . "<br>";
// Hình Vuông
$HinhVuong = new HinhVuong();
$HinhVuong->Ve();
$HinhVuong->canh = 20;
echo "<br>Diện tích hình vuông:" . $HinhVuong->tinh_Dien_Tich(); ?>