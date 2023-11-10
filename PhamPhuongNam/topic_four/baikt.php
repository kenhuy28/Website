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
    function printSV($list)
    {
        $chuoi = "";
        foreach ($list as $l) {
            $str = implode('---', $l);
            $chuoi .= $str . "\n";
        }
        return $chuoi;
    }
    function add(&$list, $maLop,$maSV,$Ten,$GT,$NS) {
        $arr = array( $maLop,
         $maSV,
        $Ten,
        $GT,
         $NS);
        array_push($list,$arr);
        //printSV($list);
    }

    function tach($str, $list) {
            $aray=array();
            $list=explode('\n',$str);
            foreach($list as $l) {
                $m=explode('---',$l);
                array_push($aray,$m);
            }
            return $aray;
    }
    function writeF($str) {
        $file_path = "Phạm Phương Nam_62133960.dat";
        file_put_contents($file_path, $str);
    }

    $list = array(
        array(
            "62.CNTT-1",
            "6212341",
            "Nguyễn Minh Anh",
            "Nữ",
            "2002-08-09"
        ),
        array(
            "62.CNTT-1",
            "6210123",
            "Trần Anh Tú",
            "Nam",
            "2002-05-21"
        ),
        array(
            "62.CNTT-2",
            "6211012",
            "Nguyễn Ngọc Thanh",
            "Nam",
            "2002-02-30"
        ),
        array(
            "62.CNTT-3",
            "6210124",
            "Lê Phương Thảo",
            "Nữ",
            "2002-10-15"
        ),
    );
    $warning = "";
    $check = true;
    if (isset($_POST['maLop'])) {
        $maLop = trim($_POST['maLop']);
    } else {
        $maLop = "";
    }
    if (isset($_POST['maSV'])) {
        $maSV = trim($_POST['maSV']);
    } else {
        $maSV = "";
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
    } else {
        $NS = "";
    }
    if (isset($_POST['str'])) {
        $str = trim($_POST['str']);
        //echo $str;
        $str = substr($str, 0, -1);
        $list = tach($str,$list);
        //printSV($list);
    } else {
        $str = "";
        
    }
    
    if (isset($_POST['Them'])) {
        if ($maLop != "" && $maSV!= "" && $Ten!="" && $GT!="" && $NS!="") {
            add($list,$maLop,$maSV,$Ten,$GT,$NS);
            $maLop = ""; $maSV= ""; $Ten=""; $GT=""; $NS="";
            $check = true;
        }else {
            $check = false;
        }
    }
    if ($check == false) {
        $warning = "Cần nhập đầy đủ các trường";
    }
    $chuoi = printSV($list);
    //echo printSV($list);
    if (isset($_POST['Luu'])) {
        writeF($chuoi);
    }
    ?>

    <form align='center' action="baikt.php" method="post">

        <table style="width: 700px;" >
            <thead>

                <th colspan="2" align="center">
                    <h3>THÊM SINH VIÊN</h3>
                </th>
            </thead>
            <tr>
                <td colspan="2" align="center"><h3 style="color: red;"></h3><?php echo $warning; ?></h3></td>
            </tr>
            <tr>
                <td>Lớp:</td>
                <td><select name="maLop">
                        <option value="">-- Chọn lớp --</option>
                        <option value="62.CNTT-1" <?php if($maLop=="62.CNTT-1") echo"selected";?>>62.CNTT-1</option>
                        <option value="62.CNTT-2" <?php if($maLop=="62.CNTT-2") echo"selected";?>>62.CNTT-2</option>
                        <option value="62.CNTT-3" <?php if($maLop=="62.CNTT-3") echo"selected";?>>62.CNTT-3</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mã số sinh viên:</td>

                <td><input style="width: 80%;" colspan="1" type="text" name="maSV" value="<?php echo $maSV; ?>" /></td>

            </tr>
            <tr>
                <td>Tên:</td>
                <td><input style="width: 80%;" colspan="1" type="text" name="Ten" value="<?php echo $Ten; ?>" /></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>
                    <input colspan="1" type="radio" value="Nam" name="GT"<?php if($GT=="Nam") echo"checked";?>  />Nam
                    <input colspan="1" type="radio" value="Nữ" name="GT"<?php if($GT=="Nữ") echo"checked";?> />Nữ
                </td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>

                <td><input colspan="1" type="date" name="NS" value="<?php echo $NS; ?>" /></td>

            </tr>
            <tr>
                <td></td>
                <td colspan="1"><input type="submit" value="Thêm" name="Them" />
                <input type="submit" value="Lưu" name="Luu" /></td>
            </tr>
            <tr style="display: none">
                <td colspan="2"><Textarea name="str" style="width: 100%; min-height: 400px;"><?php echo $chuoi; ?></Textarea></td>
            </tr>

        </table>
    </form>




</body>



</html>