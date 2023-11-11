<?php class HocSinh
{
    private $ma;
    public $ho;
    public $ten;
    public $ngaysinh;
    private $diemtb;
    const HESO = 2;
    function setMa($maHS)
    {
        $this->ma = $maHS; //truy cập thuộc tỉnh trong lớp
    }
    function getMa()
    {
        return $this->ma;
    }
    function getHoten()
    {
        return $this->ho . ' ' . $this->ten; //truy cập thuộc tỉnh trong lớp
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
    

	/**
	 * @param mixed $diemtb 
	 * @return self
	 */
	public function setDiemtb($diemtb): self {
		$this->diemtb = $diemtb;
		return $this;
	}
}
$hs1 = new HocSinh();
$hs1->setMa("12345");
$hs1->ho = "Đào Văn";
$hs1->ten = "Minh";
$hs1->ngaysinh = "15/12/2012";
$hs1->setDiemtb(5);
echo "<h3>Thông tin học sinh</h3>";
echo "<br>Họ tên: {$hs1->getHoten()}";
echo "<br>Tuổi: {$hs1->getTuoi()}";
echo "<br>Mã: {$hs1->getMa()}";
echo "<br>Điểm trung bình đã nhân hệ số: {$hs1->tinhDiem()}";
?>