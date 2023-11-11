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
    abstract class NhanVien
    {
        public $Name;
        public $sex;    
        public $birthday;
        public $workday;
        public $hesoluong;
        public $socon;
        protected const salary = 2000000;
        
        public function __construct($Name, $sex, $birthday,$workday, $hesoluong, $socon) {
            $this->Name = $Name;
            $this->sex = $sex;
            $this->birthday = $birthday;
            $this->workday = $workday;
            $this->hesoluong = $hesoluong;
            $this->socon = $socon;
        }
        function getYear($day) {
            $ns = explode("/", $day);
            return date("Y") - $ns[2];
        }
        function tinhThuong() {
            $year = $this->getYear($this->workday);
            return $year*1000000;
        }
    }
    class VanPhong extends NhanVien{
        public $songayvang;
        public $dinhmucvang = 3;
        public $dongiaphat = 50000;

        public function __construct($Name, $sex, $birthday,$workday, $hesoluong, $socon,$songayvang) {
            parent::__construct($Name, $sex, $birthday,$workday, $hesoluong, $socon);
            $this->songayvang = $songayvang;
        }
        function tienPhat() {
            if($this->songayvang > $this->dinhmucvang) {
                return $this->songayvang*$this->dongiaphat;
            } else {
                return 0;
            } 
        }
        function tienTroCap() {
            if($this->sex == "Nữ") {
                return $this->socon*200000*1.5;
            } else {
                return $this->socon*200000;
            } 
        }
        function tienLuong() {
            return self::salary*$this->hesoluong - $this->tienPhat();
        }
    }
    class SanPham extends NhanVien{
        public $sonsanpham;
        public $dinhmucsanpham = 50;
        public $dongiasanpham = 300000;
        public function __construct($Name, $sex, $birthday,$workday, $hesoluong, $socon,$sonsanpham) {
            parent::__construct($Name, $sex, $birthday,$workday, $hesoluong, $socon);
            $this->sonsanpham = $sonsanpham;
        }
        function tienThuong() {
            if($this->sonsanpham > $this->dinhmucsanpham) {
                return ($this->sonsanpham-$this->dinhmucsanpham)*$this->dongiasanpham*0.03;
            } else {
                return 0;
            } 
        }
        function tienTroCap() {
            return $this->socon*120000;
        }
        function tienLuong() {
            return $this->sonsanpham*$this->dongiasanpham+$this->tienThuong();
        }
    }
    $warning = "";
    $check = true;
    if (isset($_POST['name'])) {
        $name = trim($_POST['name']);
    } else {
        $name = "";
    }
    if (isset($_POST['children'])) {
        $children = trim($_POST['children']);
    } else {
        $children = 0;
    }
    if (isset($_POST['birthday'])) {
        $birthday = trim($_POST['birthday']);
    } else {
        $birthday = "";
    }
    if (isset($_POST['workday'])) {
        $workday = trim($_POST['workday']);
    } else {
        $workday = "";
    }
    if (isset($_POST['GT'])) {
        $GT = trim($_POST['GT']);
    } else {
        $GT = "";
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
    if (isset($_POST['salary'])) {
        $salary = trim($_POST['salary']);
    } else {
        $salary = "";
    }
    if (isset($_POST['TC'])) {
        $TC = trim($_POST['TC']);
    } else {
        $TC = "";
    }
    if (isset($_POST['thuong'])) {
        $thuong = trim($_POST['thuong']);
    } else {
        $thuong = "";
    }
    if (isset($_POST['phat'])) {
        $phat = trim($_POST['phat']);
    } else {
        $phat = "";
    }
    if (isset($_POST['songayvang'])) {
        $songayvang = trim($_POST['songayvang']);
    } else {
        $songayvang = 0;
    }
    if (isset($_POST['sosanpham'])) {
        $sosanpham = trim($_POST['sosanpham']);
    } else {
        $sosanpham = 0;
    }
    if (isset($_POST['thucLinh'])) {
        $thucLinh = trim($_POST['thucLinh']);
    } else {
        $thucLinh = "";
    }
    if (isset($_POST['Tinh'])) {
        if ($staffType == "Văn phòng") {
            $nv = new VanPhong($name, $GT, $birthday,$workday, $hs, $children,$songayvang);
            $phat=$nv->tienPhat();
            $thuong=$nv->tinhThuong();
            $salary =$nv->tienLuong();
            $TC = $nv->tienTroCap();
            $thucLinh = $thuong+$salary+$TC;
        } else if ($staffType == "Sản xuất"){
            $nv = new SanPham($name, $GT, $birthday,$workday, $hs, $children,$sosanpham);
            $phat=0;
            $thuong=$nv->tinhThuong();
            $salary =$nv->tienLuong();
            $TC = $nv->tienTroCap();
            $thucLinh = $thuong+$salary+$TC;
        }
    }
   
    ?>

    <form align='center' action="2.php" method="post">

        <table style="width: 700px;">
            <thead>

                <th colspan="4" align="center">
                    <h3>QUẢN LÝ NHÂN VIÊN</h3>
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
                <td>Họ tên nhân viên:</td>
                <td><input colspan="1" type="text" name="name" value="<?php echo $name; ?>" /></td>
                <td>Số con:</td>
                <td><input style="width: 30%;" colspan="1" type="text" name="children"
                        value="<?php echo $children; ?>" /></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="birthday"
                        value="<?php echo $birthday; ?>" /></td>
                <td>Ngày vào làm:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="workday" value="<?php echo $workday; ?>" />
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
                <td>Hệ số lượng:</td>
                <td><input style="width: 40%;" colspan="1" type="text" name="hs" value="<?php echo $hs; ?>" /></td>
            </tr>
            <tr>
                <td>Loại nhân viên:</td>
                <td>
                    <input colspan="1" type="radio" value="Văn phòng" name="staffType" <?php if ($staffType == "Văn phòng")
                        echo "checked"; ?> />Văn phòng
                </td>
                <td>
                    <input colspan="1" type="radio" value="Sản xuất" name="staffType" <?php if ($staffType == "Sản xuất")
                        echo "checked"; ?> />Sản xuất
                </td>
            </tr>
            <tr>
                <td>Số ngày vắng:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="songayvang" value="<?php echo $songayvang; ?>" />
                </td>
                <td>Số sản phẩm:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="sosanpham" value="<?php echo $sosanpham; ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" align="center"><input type="submit" value="Tính lương" name="Tinh" />
            </tr>
            <tr>
                <td>Tiền lương:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="salary" disabled value="<?php echo $salary; ?>" />
                </td>
                <td>Trợ cấp:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="TC" disabled value="<?php echo $TC; ?>" /></td>
            </tr>
            <tr>
                <td>Tiền thưởng:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="thuong" disabled value="<?php echo $thuong; ?>" />
                </td>
                <td>Tiền phạt:</td>
                <td><input style="width: 60%;" colspan="1" type="text" name="phat" disabled value="<?php echo $phat; ?>" /></td>
            </tr>
            <tr>
                <td  colspan="4" align="center">Thực lĩnh: <input style="width: 40%;" colspan="1" disabled type="text" name="thucLinh" value="<?php echo $thucLinh; ?>" />
                </td>
            </tr>
        </table>
    </form>
</body>



</html>