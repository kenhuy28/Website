<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>tinh dien tich HCN</title>

    <style type="text/css">
        div{
            background-color: blue;
            padding-top: 4px;
        }
        body {
            align-items: center;
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
    if (isset($_POST['a'])) {
        $a = trim($_POST['a']);
    } else {
        $a = 0;
    }
    if (isset($_POST['b'])) {
        $b = trim($_POST['b']);
    } else {
        $b = 0;
    }
    function isLeapYear($year) {
        if ($year % 4 == 0) {
            if ($year % 100 == 0) {
                if ($year % 400 == 0) {
                    return true; 
                } else {
                    return false; 
                }
            } else {
                return true; 
            }
        } else {
            return false; 
        }
    }
    $kq1="";
    if ($a!=0) {
        for ($i=$a; $i<=2000;$i++) {
            if (isLeapYear($i)) {
                $kq1 .= $i ." ";
            }
        }
        $kq1 .= "Là năm nhuận";
    }
    $kq2="";
    if ($b >= 2000 ) {
        for ($i=2000; $i<$b;$i++) {
            if (isLeapYear($i)) {
                $kq2 .= $i ." ";
            }
        }
        $kq2 .= "Là năm nhuận";
    }
    
    ?>
    <div style="width: 500px;" align="center" style = " background-color: red">
    <form action="2.php" method="post">
            <h4>Năm nhập vào nhỏ hơn 2000</h4>
            <table style="min-width: 500px;">
                <thead>
                    <td colspan="2" align="center"><h1>Tìm năm nhuận</h1></td>
                </thead>
                <tr align="center">
                    <td>Năm:</td>
                    <td><input type="number" name="a" min="1" max="1999" value="<?php echo $a; ?>"/></td>
                </tr>
                <tr>
                    <td " align=" center" colspan="2"><input type="submit" value="Caculate" name="tinh" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><textarea name="" id=""style="min-width: 400px;"> <?php echo $kq1; ?></textarea></td>
                </tr>
            </table>
            <h4>Năm nhập vào lớn hơn 2000</h4>
            <table style="min-width: 500px;">
                <thead>
                    <td colspan="2" align="center"><h1>Tìm năm nhuận</h1></td>
                </thead>
                <tr align="center">
                    <td>Năm:</td>
                    <td><input type="number" name="b" min="2000" value="<?php echo $b; ?>"/></td>
                </tr>
                <tr>
                    <td " align=" center" colspan="2"><input type="submit" value="Caculate" name="tinh" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><textarea name="" id=""style="min-width: 400px;"><?php echo $kq2; ?></textarea></td>
                </tr>
            </table>
        </form>
    </div>

</body>



</html>