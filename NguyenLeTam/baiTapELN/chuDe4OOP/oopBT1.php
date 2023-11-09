<?php
class Nguoi
{
  protected $hoTen;
  protected $diaChi;
  protected $gioiTinh;
}
class SinhVien extends Nguoi
{
  protected $lop;
  protected $nganhHoc;
  public function tinhDiemThuong()
  {
    if ($this->nganhHoc == "CNTT")
      return 1;
    if ($this->nganhHoc == "KT")
      return 1.5;
    return 0;
  }
}
final class GiangVien extends Nguoi
{
  protected $trinhDo;
  const luongCoBan = 1500000;
  public function tinhLuong()
  {
    if ($this->trinhDo == "cunhan")
      return self::luongCoBan * 2.34;
    if ($this->trinhDo == "thacsi")
      return self::luongCoBan * 3.67;
    if ($this->trinhDo == "tiensi")
      return self::luongCoBan * 5.66;
  }
}
?>