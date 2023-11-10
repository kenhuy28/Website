<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Thêm nhân viên</title>

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
    function printSV($list)
    {
        $chuoi = "";
        foreach ($list as $l) {
            $str = implode('---', $l);
            $chuoi .= $str . "\n";
        }
        return $chuoi;
    }
    function add(&$list, $maPB, $maNV, $Ten, $GT, $NS, $DC, $Email)
    {
        $arr = array(
            $maPB,
            $maNV,
            $Ten,
            $GT,
            $NS,
            $DC,
            $Email
        );
        array_push($list, $arr);
        //printSV($list);
    }
    function tach($str, $list)
    {
        $aray = array();
        $list = explode('\n', $str);
        foreach ($list as $l) {
            $m = explode('---', $l);
            array_push($aray, $m);
        }
        return $aray;
    }
    function writeF($str)
    {
        $file_path = "PhamPhuongNam_62133960.txt";
        file_put_contents($file_path, $str);
    }
    function checkNgay($date) {
        $check =true;
        $thang31ngay = array(1, 3, 5, 7, 8, 10, 12);
        $thang30ngay = array(4, 6, 9, 11);
        $ns = explode("-", $date);
        $ns = array_map('intval', $ns);
        if ($ns[0] < 0 || $ns[0] >= date("Y")) {
            $check = false;
        }
        if ($ns[1] < 1 || $ns[1] >= 12) {
            $check = false;
        }
        if (in_array($ns[1], $thang31ngay)==true) {
            if ($ns[2]<1 || $ns[2] >31) {
                $check = false;
            }
        } else if (in_array($ns[1], $thang30ngay)==true){
            if ($ns[2] <1 || $ns[2] >30) {
                $check = false;
            }
        } 
        return $check;
    }
    function checkEmail($Email) {
        $check = true;
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $check = false;
        }
        return $check;
    }
    $list = array();
    $warning = "";
    $check = true;
    if (isset($_POST['maPB'])) {
        $maPB = trim($_POST['maPB']);
    } else {
        $maPB = "";
    }
    if (isset($_POST['maNV'])) {
        $maNV = trim($_POST['maNV']);
    } else {
        $maNV = "";
    }
    if (isset($_POST['Ten'])) {
        $Ten = trim($_POST['Ten']);
    } else {
        $Ten = "";
    }
    if (isset($_POST['GT'])) {
        $GT = trim($_POST['GT']);
    } else {
        $GT = "";
    }
    if (isset($_POST['NS'])) {
        $NS = trim($_POST['NS']);
        //echo $NS;
    } else {
        $NS = "";
    }
    if (isset($_POST['DC'])) {
        $DC = trim($_POST['DC']);
    } else {
        $DC = "";
    }
    if (isset($_POST['Email'])) {
        $Email = trim($_POST['Email']);
    } else {
        $Email = "";
    }
    if (isset($_POST['str'])) {
        $str = trim($_POST['str']);
        //echo $str;
        //$str = substr($str, 0, -1);
        $list = tach($str, $list);
        //printSV($list);
    } else {
        $str = "";

    }

    if (isset($_POST['Them'])) {
        if ($maPB != "" && $maNV != "" && $Ten != "" && $GT != "" && $NS != "" && $DC != "" && $Email != "") {
            if (checkEmail($Email)==true) {
                add($list, $maPB, $maNV, $Ten, $GT, $NS, $DC, $Email);
                $maPB = "";
                $maNV = "";
                $Ten = "";
                $GT = "";
                $NS = "";
                $DC = "";
                 $Email = "";
                 $warning = "Thêm thành công";
                $check = true;
            } else {
                if (checkEmail($Email)==false) {
                    $warning = "Yêu cầu nhập đúng trường Email";
                }
            }
        } else {
            $warning = "Cần nhập đầy đủ các trường";
        }
    }

    $chuoi = printSV($list);
    //echo printSV($list);
    if (isset($_POST['Luu'])) {
        writeF($chuoi);
        $warning = "Lưu thành công";
    }
    ?>

    <form align='center' action="PhamPhuongNam_62133960.php" method="post">

        <table style="width: 800px;">
            <thead>

                <th colspan="2" align="center">
                    <h3>THÊM NHÂN VIÊN</h3>
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
                <td>Phòng ban:</td>
                <td><select name="maPB">
                        <option value="">-- Chọn phòng ban --</option>
                        <option value="Hành chính" <?php if ($maPB == "Hành chính")
                            echo "selected"; ?>>Hành chính</option>
                        <option value="Kế toán" <?php if ($maPB == "Kế toán")
                            echo "selected"; ?>>Kế toán</option>
                        <option value="Nhân sự" <?php if ($maPB == "Nhân sự")
                            echo "selected"; ?>>Nhân sự</option>
                        <option value="Tiếp thị" <?php if ($maPB == "Tiếp thị")
                            echo "selected"; ?>>Tiếp thị</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mã nhân viên:</td>

                <td><input style="width: 80%;" colspan="1" type="text" name="maNV" value="<?php echo $maNV; ?>" /></td>

            </tr>
            <tr>
                <td>Tên nhân viên:</td>
                <td><input style="width: 80%;" colspan="1" type="text" name="Ten" value="<?php echo $Ten; ?>" /></td>
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
                <td>Ngày sinh:</td>

                <td><input colspan="1" type="date" name="NS" value="<?php echo $NS; ?>" /></td>

            </tr>
            <tr>
                <td>Địa chỉ:</td>

                <td><input style="width: 80%;" colspan="1" type="text" name="DC" value="<?php echo $DC; ?>" /></td>

            </tr>
            <tr>
                <td>Email:</td>
                <td><input style="width: 80%;" colspan="1" type="text" name="Email" value="<?php echo $Email; ?>" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1"><input type="submit" value="Thêm" name="Them" />
                    <input type="submit" value="Lưu" name="Luu" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><Textarea name="str"
                        style="width: 100%; min-height: 400px;"><?php echo $chuoi; ?></Textarea></td>
            </tr>
        </table>
    </form>




</body>



</html>