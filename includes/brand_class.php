<?php
class ThuongHieu
{
    private $maThuongHieu;
    private $tenThuongHieu;
    private $logo;
    function __construct($maThuongHieu, $tenThuongHieu, $logo)
    {
        $this->maThuongHieu = $maThuongHieu;
        $this->tenThuongHieu = $tenThuongHieu;
        $this->logo = $logo;
    }

    //functions get value from object
    public function getMaThuongHieu()
    {
        return $this->maThuongHieu;
    }
    public function getTenThuongHieu()
    {
        return $this->tenThuongHieu;
    }
    public function getLogo()
    {
        return $this->logo;
    }
}
?>