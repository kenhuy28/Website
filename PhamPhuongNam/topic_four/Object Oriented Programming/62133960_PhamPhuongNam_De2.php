<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>tinh dien tich HCN</title>

    <style type="text/css">
        body {

            background-color: #d24dff;

        }

        table {

            background: #ffd94d;

            border: 0 solid yellow;

        }

        thead {

            background: #fff14d;


        }

        td {

            color: blue;

        }

        h3 {

            font-family: verdana;

            text-align: center;

            /* text-anchor: middle; */

            color: #ff8100;

            font-size: medium;

        }
    </style>

</head>



<body>

    <?php
    abstract class CanBo
    {
        protected $maSO;
        protected $hoTen;
        protected $gioiTinh;
        protected $ngaySinh;
        protected $DVCT;
        public function __construct($maSO, $hoTen, $gioiTinh, $ngaySinh, $DVCT){
            $this->maSO = $maSO;
            $this->hoTen = $hoTen;
            $this->gioiTinh = $gioiTinh;
            $this->ngaySinh = $ngaySinh;
            $this->DVCT = $DVCT;
        }

        public function getMaSO(){
            return $this->maSO;
        }
        public function getHoTen(){
            return $this->hoTen;
        }
        public function getGioiTinh(){
            return $this->gioiTinh;
        }
        public function getNgaySinh(){
            return $this->ngaySinh;
        }
        public function getDVCT(){
            return $this->DVCT;
        }
        public function setMaSO($maSO){
            $this->maSO = $maSO;
        }
        public function setHoTen($hoTen){
            $this->hoTen = $hoTen;
        }
        public function setGioiTinh($gioiTinh){
            $this->gioiTinh = $gioiTinh;
        }
        public function setNgaySinh($ngaySinh){
            $this->ngaySinh = $ngaySinh;
        }
        public function setDVCT($DVCT){
            $this->DVCT = $DVCT;
        }
        abstract function tinhThuong();
    }
    class GiangVien extends CanBo{
        private $ngayVeTruong;
        private $hocVi; 
        private $soDonViNghienCuu;
        const donGiaBaiBao = 10000000;
        public function __construct($maSO, $hoTen, $gioiTinh, $ngaySinh, $DVCT, $ngayVeTruong, $hocVi,$soDonViNghienCuu){
            parent::__construct($maSO, $hoTen, $gioiTinh, $ngaySinh, $DVCT);
            $this->ngayVeTruong = $ngayVeTruong;
            $this->hocVi = $hocVi;
            $this->soDonViNghienCuu = $soDonViNghienCuu;
        }  
        public function getNgayVeTruong(){
            return $this->ngayVeTruong;
        }
        public function getHocVi(){
            return $this->hocVi;
        }
        public function getSoDonViNghienCuu(){
            return $this->soDonViNghienCuu;
        }
        public function setNgayVeTruong($ngayVeTruong){
            $this->ngayVeTruong = $ngayVeTruong;
        }
        public function setHocVi($hocVi){
            $this->hocVi = $hocVi;
        }
        public function setSoDonViNghienCuu($soDonViNghienCuu){
            $this->soDonViNghienCuu = $soDonViNghienCuu;
        }
        public function tinhThuong(){
            if ($this->hocVi == "Thặc sĩ" || $this->hocVi == "Tiến sĩ") {
                if ($this->soDonViNghienCuu <= 2) {
                    return self::donGiaBaiBao*$this->soDonViNghienCuu;
                } 
            } 
            if ($this->hocVi == "Phó giáo sư" || $this->hocVi == "Tiến sĩ") {
                if ($this->soDonViNghienCuu >= 3) {
                    return self::donGiaBaiBao*$this->soDonViNghienCuu*1.5;
                } 
            } 
            return 0;
        } 
    }
    class ChuyenVien extends CanBo{
        private $chucVu;
        private $soSangkienCaiThien;
        public function __construct($maSO, $hoTen, $gioiTinh, $ngaySinh, $DVCT,$chucVu, $soSangkienCaiThien){
            parent::__construct($maSO, $hoTen, $gioiTinh, $ngaySinh, $DVCT);
            $this->chucVu = $chucVu;
            $this->soSangkienCaiThien = $soSangkienCaiThien;
        }
        public function getChucVu(){
            return $this->chucVu;
        }
        public function getSoSangkienCaiThien(){
            return $this->soSangkienCaiThien;
        }
        public function setChucVu($chucVu){
            $this->chucVu = $chucVu;
        }
        public function setSoSangkienCaiThien($soSangkienCaiThien){
            $this->soSangkienCaiThien = $soSangkienCaiThien;
        }
        public function tinhThuong(){
            $tienThuong = $this->soSangkienCaiThien*2000000;
            if ($this->chucVu == "Trưởng phòng") {
                $tienThuong = $tienThuong+500000;
            } else if ($this->chucVu == "Phó phòng") {
                $tienThuong = $tienThuong+300000;
            }else if ($this->chucVu == "Thư ký") {
                $tienThuong = $tienThuong+100000;
            }
            return $tienThuong;
        }
    }
    $warning = "";
    $check = true;
    if (isset($_POST['name'])) {
        $name = trim($_POST['name']);
    } else {
        $name = "";
    }
    if (isset($_POST['maso'])) {
        $maso = trim($_POST['maso']);
    } else {
        $maso = "";
    }
    if (isset($_POST['birthday'])) {
        $birthday = trim($_POST['birthday']);
    } else {
        $birthday = "";
    }
    if (isset($_POST['DVCT'])) {
        $DVCT = trim($_POST['DVCT']);
    } else {
        $DVCT = "";
    }
    if (isset($_POST['GT'])) {
        $GT = trim($_POST['GT']);
    } else {
        $GT = "";
    }
    if (isset($_POST['CV'])) {
        $CV = trim($_POST['CV']);
    } else {
        $CV = "";
    }
    if (isset($_POST['hs'])) {
        $hs = trim($_POST['hs']);
    } else {
        $hs = "";
    }
    if (isset($_POST['staffType'])) {
        $staffType = trim($_POST['staffType']);
    } else {
        $staffType = "";
    }
    if (isset($_POST['thuong'])) {
        $thuong = trim($_POST['thuong']);
    } else {
        $thuong = "";
    }
    if (isset($_POST['HV'])) {
        $HV = trim($_POST['HV']);
    } else {
        $HV = "";
    }
    if (isset($_POST['nvt'])) {
        $nvt = trim($_POST['nvt']);
    } else {
        $nvt = "";
    }
    if (isset($_POST['SKT'])) {
        $SKT = trim($_POST['SKT']);
    } else {
        $SKT = 0;
    }
    if (isset($_POST['SCTNC'])) {
        $SCTNC = trim($_POST['SCTNC']);
    } else {
        $SCTNC = 0;
    }
    if (isset($_POST['result'])) {
        $result = trim($_POST['result']);
    } else {
        $result = "";
    }
    function writeA($str)
    {
        $file_path = "62133960_PhamPhuongNam_De2_GiangVien.txt";
        $fp = @fopen($file_path,"a+");
        fwrite($fp, $str);
        fclose($fp);
    }
    function writeB($str)
    {
        $file_path = "62133960_PhamPhuongNam_De2_ChuyenVien.txt";
        $fp = @fopen($file_path,"a+");
        fwrite($fp, $str);
        fclose($fp);
    }
    $m ='';
    if (isset($_POST['Luu'])) {
        if ($staffType == "Giảng viên") {
            $gv = new GiangVien($maso, $name, $GT, $birthday, $DVCT, $nvt, $HV,$SCTNC);
            $result = " Họ tên:".  $gv->getHoTen() ."\n mã số:".$gv->getMaSO() ."\n giới tính:".$gv->getGioiTinh() ."\n ngày sinh:".$gv->getNgaySinh() ."\n Đơn vị công tác:".$gv->getDVCT() 
            ."\n Ngày về trường".$gv->getNgayVeTruong() ."\n học vị:".$gv->getHocVi() ."\n số đơn vị nghiên cứu".$gv->getSoDonViNghienCuu()."\n tính thưởng".$gv->tinhThuong();
            writeA($result);
            writeA("\n----------------------------------------\n");
        } else if ( $staffType == "Chuyên viên"){
            $cv = new ChuyenVien($maso, $name, $GT, $birthday, $DVCT,$CV,$SKT);
            $result = " Họ tên:". $cv->getHoTen() ."\n mã số:".$cv->getMaSO() ."\n giới tính:".$cv->getGioiTinh() ."\n ngày sinh:".$cv->getNgaySinh() ."\n Đơn vị công tác:".$cv->getDVCT() 
            ."\n Chức vụ".$cv->getChucVu() ."\n Số sáng kiến".$cv->getSoSangkienCaiThien()."\n tính thưởng:".$cv->tinhThuong();
            writeB($result);
            writeB("\n----------------------------------------\n");
        }
    }
    if (isset($_POST['Tinh'])) {
        if ($staffType == "Giảng viên") {
            $m = file_get_contents('62133960_PhamPhuongNam_De2_GiangVien.txt');
        } else if ( $staffType == "Chuyên viên"){
            $m = file_get_contents('62133960_PhamPhuongNam_De2_ChuyenVien.txt');
        }
    }
    ?>

    <form align='center' action="62133960_PhamPhuongNam_De2.php" method="post">

        <table style="width: 900px;">
            <thead>

                <th colspan="4" align="center">
                    <h3>QUẢN LÝ CÁN BỘ</h3>
                </th>
            </thead>
            <tr>
                <td colspan="2" align="center">
                    <h3 style="color: red;"></h3>
                    <?php echo $warning; ?>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>Họ tên cán bộ:</td>
                <td><input colspan="1" type="text" name="name" value="<?php echo $name; ?>" /></td>
                <td>Mã số:</td>
                <td><input style="width: 30%;" colspan="1" type="text" name="maso"
                        value="<?php echo $maso; ?>" /></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="birthday"
                        value="<?php echo $birthday; ?>" /></td>
                <td>đơn vị công tác:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="DVCT" value="<?php echo $DVCT; ?>" />
                </td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>
                    <input colspan="1" type="radio" value="Nam" name="GT" <?php if ($GT == "Nam")
                        echo "checked"; ?> />Nam
                    <input colspan="1" type="radio" value="Nữ" name="GT" <?php if ($GT == "Nữ")
                        echo "checked"; ?> />Nữ
                </td>
                
            </tr>
            <tr>
                <td>Loại cán bộ:</td>
                <td>
                    <input colspan="1" type="radio" value="Giảng viên" name="staffType" <?php if ($staffType == "Giảng viên")
                        echo "checked"; ?> />Giảng viên
                </td>
                <td>
                    <input colspan="1" type="radio" value="Chuyên viên" name="staffType" <?php if ($staffType == "Chuyên viên")
                        echo "checked"; ?> />Chuyên viên
                </td>
            </tr>
            <tr>
                <td>Ngày về trường:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="nvt" value="<?php echo $nvt; ?>" />
                </td>
                <td>Chức vụ:</td>
                <td><input  colspan="1" type="radio" name="CV" value="Trưởng phòng" /> Trưởng phòng <?php if ($CV == "Trưởng phòng")
                        echo "checked"; ?>
                <input  colspan="1" type="radio" name="CV" value="Phó phòng" <?php if ($CV == "Phó phòng")
                        echo "checked"; ?>/> Phó phòng 
                <input  colspan="1" type="radio" name="CV" value="Thư ký" <?php if ($CV == "Thư ký")
                        echo "checked"; ?>/> Thư ký</td>
            </tr>
            <tr>
                <td>Học vị:</td>
                <td><input  colspan="1" type="radio" name="HV" value="Thạc sĩ" <?php if ($HV == "Thạc sĩ")
                        echo "checked"; ?>/> Thạc sĩ
                <input  colspan="1" type="radio" name="HV" value="Tiến sĩ" <?php if ($HV == "Tiến sĩ")
                        echo "checked"; ?> /> Tiến sĩ 
                <input  colspan="1" type="radio" name="HV" value="Phó giáo sư" <?php if ($HV == "Phó giáo sư")
                        echo "checked"; ?> /> Phó giáo sư
                </td>
                <td>Số sáng kiến tạo</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="SKT" value="<?php echo $SKT; ?>" /></td>
            </tr>
            <tr>
                <td>Số công trình nghiên cứu:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="SCTNC" value="<?php echo $SCTNC; ?>" />
                </td>
              
            </tr>
            <tr>
                <td></td>
                <td  align="center"><input type="submit" value="Hiển thị thông tin" name="Tinh" /></td>
                <td  align="center"><input type="submit" value="Luu" name="Luu" /></td>
            </tr>
            <tr>
                <td colspan="5"><textarea name="result" id="" cols="120" rows="10"><?php echo $m;?> </textarea>
                </td>
            </tr>
        </table>
    </form>
</body>



</html>