<?php
abstract class NhanVien
{
    var $hoTen;
    var $gioiTinh;
    var $ngayVaoLam;
    var $heSoLuong;
    var $soCon;
    const luongCoBan = 1300000;
    abstract function tinhTienLuong();
    abstract function tinhTroCap();
    function tinhTienThuong()
    {
        $timestamp = strtotime($this->ngayVaoLam);
        $nam = date("Y", $timestamp);
        return ((int) date("Y") - (int) $nam) * 1000000;
    }
}

final class NhanVienVanPhong extends NhanVien
{
    var $soNgayVang;
    const dinhMucVang = 5;
    const donGiaPhat = 50000;
    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang)
    {
        $this->hoTen=$hoTen;
        $this->gioiTinh=$gioiTinh;
        $this->ngayVaoLam=$ngayVaoLam;
        $this->heSoLuong=$heSoLuong;
        $this->soCon=$soCon;
        $this->soNgayVang=$soNgayVang;

    }
    public function tinhTienPhat()
    {
        if ($this->soNgayVang > self::dinhMucVang)
            return $this->soNgayVang * self::donGiaPhat;
        return 0;
    }
    function tinhTroCap()
    {
        if ($this->gioiTinh == "Nu")
            return 200000 * $this->soCon * 1.5;
        return 200000 * $this->soCon;
    }
    function tinhTienLuong()
    {
        return self::luongCoBan * $this->heSoLuong - self::tinhTienPhat();
    }
}

final class NhanVienSanXuat extends NhanVien
{
    var $soSanPham;
    const dinhMucSanPham = 100;
    const donGiaSanPham = 20000;
    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soSanPham)
    {
        $this->hoTen=$hoTen;
        $this->gioiTinh=$gioiTinh;
        $this->ngayVaoLam=$ngayVaoLam;
        $this->heSoLuong=$heSoLuong;
        $this->soCon=$soCon;
        $this->soSanPham=$soSanPham;

    }
    function tinhTienThuong()
    {
        if ($this->soSanPham > self::dinhMucSanPham)
            return ($this->soSanPham - self::dinhMucSanPham) * self::donGiaSanPham * 0.03;
        return 0;
    }
    function tinhTroCap()
    {
        return $this->soCon * 120000;
    }
    function tinhTienLuong()
    {
        return $this->soSanPham * self::donGiaSanPham + self::tinhTienThuong();
    }
}
?>