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

        .student_page {
            display: none;
        }

        #lecture {
            display: none;
        }
    </style>


</head>



<body>

    <?php
    abstract class Human
    {
        public $name;
        public $address;
        public $sex;
        public function __construct($name, $address, $sex)
        {
            $this->name = $name;
            $this->address = $address;
            $this->sex = $sex;
        }
        abstract public function toString();
    }

    class Student extends Human
    {
        public $class;
        public $major;
        public function __construct($name, $address, $sex, $class, $major)
        {
            parent::__construct($name, $address, $sex);
            $this->class = $class;
            $this->major = $major;
        }
        public function rewardPoints()
        {
            if ($this->major == "CNTT") {
                return 1;
            } else if ($this->major == "Kinh tế") {
                return 1.5;
            }
            return 0;
        }
        public function toString(){
            $string = $this->name . "\n" . $this->address . "\n" .
            $this->sex . "\n" . $this->class. "\n" . $this->major . "\n" . $this->rewardPoints();
            return $string;
        }
    }
    class Lecture extends Human
    {
        public $accademicLevel;
        const salary = 1500000;
        public function __construct($name, $address, $sex, $accademicLevel)
        {
            parent::__construct($name, $address, $sex);
            $this->accademicLevel = $accademicLevel;
        }
        public function salaryCaculator()
        {
            if ($this->accademicLevel == "Cử nhân") {
                return self::salary * 2.34;
            } else if ($this->accademicLevel == "Thạc sĩ") {
                return self::salary * 3.67;
            }
            return self::salary * 5.66;
        }
        public function toString(){
            $string = $this->name . "\n" . $this->address . "\n" .
            $this->sex . "\n" . $this->accademicLevel. "\n" . $this->salaryCaculator();
            return $string;
        }
    }
    $warning = "";
    $result = "";
    if (isset($_POST['name'])) {
        $name = trim($_POST['name']);
    } else {
        $name = "";
    }
    if (isset($_POST['GT'])) {
        $GT = trim($_POST['GT']);
    } else {
        $GT = "";
    }
    if (isset($_POST['staffType'])) {
        $staffType = trim($_POST['staffType']);
    } else {
        $staffType = "";
    }
    if (isset($_POST['adrress'])) {
        $adrress = trim($_POST['adrress']);
    } else {
        $adrress = "";
    }
    if (isset($_POST['class'])) {
        $class = trim($_POST['class']);
    } else {
        $class = "";
    }
    if (isset($_POST['major'])) {
        $major = trim($_POST['major']);
    } else {
        $major = "";
    }
    if (isset($_POST['accademicLevel'])) {
        $accademicLevel = trim($_POST['accademicLevel']);
    } else {
        $accademicLevel = "";
    }
    if (isset($_POST['Tinh'])) {
        if ($staffType == "Student") {
            $hs = new Student($name, $GT,$adrress,$class,$major);
            $result = $hs->toString(); 
        } else if ($staffType == "Lecture"){
            $le = new Lecture($name, $GT,$adrress,$accademicLevel);
            $result = $le->toString(); 
        }
    }
    ?>

    <form align='center' action="1.php" method="post">

        <table>
            <thead>

                <th colspan="2" align="center">
                    <h3>QUẢN LÝ GIÁO DỤC</h3>
                </th>
            </thead>
            <tr>
                <td>Họ tên:</td>
                <td><input colspan="1" type="text" name="name" value="<?php echo $name; ?>" /></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input colspan="1" type="text" name="adrress" value="<?php echo $adrress; ?>" /></td>
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
                <td>Thuộc:</td>
                <td>
                    <input type="radio" value="Student" name="staffType" <?php if ($staffType == "Student")
                        echo "checked"; ?> />Học sinh
                    <input type="radio" value="Lecture" name="staffType" <?php if ($staffType == "Lecture")
                        echo "checked"; ?> />Giáo viên
                </td>
            </tr>
            <tr class="student_page">
                <td>Lớp học:</td>
                <td><input type="text" name="class" value="<?php echo $class; ?>" /></td>
            </tr>
            <tr class="student_page">
                <td>Nghành học:</td>
                <td><input type="text" name="major" value="<?php echo $major; ?>" /></td>
            </tr>
            <tr id="lecture">
                <td>Trình độ:</td>
                <td><input type="radio" value="Cử nhân" name="accademicLevel" <?php 
                   ?> />Cử nhân
                    <input type="radio" value="Thạc sĩ" name="accademicLevel" <?php 
                      ?> />Thạc sĩ
                    <input type="radio" value="Tiến sĩ" name="accademicLevel" <?php 
                         ?> />Tiến sĩ
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Tính lương" name="Tinh" />
            </tr>
            <tr>
                <td colspan="2"><textarea name="information" id="" cols="30" rows="10"><?php echo $result; ?></textarea>
                </td>
            </tr>
        </table>
    </form>
</body>

<script>
    const staffType = document.getElementsByName("staffType")
    var student_pages = document.getElementsByClassName("student_page");
    //console.log(staffType)
    var staffTypeValue;
    for (var i = 0; i < staffType.length; i++) {
        staffType[i].addEventListener("change", function () {
            if (this.checked) {
                var genderValue = this.value;
                if (genderValue == "Student") {
                    for (var i = 0; i < student_pages.length; i++) {
                        student_pages[i].style.display = "block";
                    }
                    document.getElementById("lecture").style.display = "none";
                } else {
                    for (var i = 0; i < student_pages.length; i++) {
                        student_pages[i].style.display = "none";
                    }
                    document.getElementById("lecture").style.display = "block";
                }
            }
        });
    }
</script>


</html>