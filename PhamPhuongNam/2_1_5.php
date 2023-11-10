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
    function Create($n) {
        $arr = [];
        for ($i = 0; $i < $n; $i++) {
            $arr[$i] = rand(0, 20);
        }
        return $arr;
    }
    function Sum($arr){
        $sum = 0;
        foreach($arr as $number) {
            $sum += $number;
        }
        return $sum;
    }

    function findMax($arr) {
        $max = $arr[0];
        foreach($arr as $number) {
            if ($max <$number) {
                $max = $number;
            }
        }
        return $max;
    }
    function findMin($arr) {
        $min = $arr[0];
        foreach($arr as $number) {
            if ($min >$number) {
                $min = $number;
            }
        }
        return $min;
    }
    $string = "";
    $arr = [];
    $sum = "";
    $max ="";
    $min ="";
    if (isset($_POST['n'])) {
        $n = trim($_POST['n']);
        $arr = Create($n);    
        $string = implode(" ", $arr);
        $sum = Sum($arr);
        $max = findMax($arr);
        $min = findMin($arr);
    } else {
        $n = "";
    }

    ?>

    <form align='center' action="2_1_5.php" method="post">

        <table>
            <thead>

                <th colspan="2" align="center">
                    <h3>NHẬP VÀ TÍNH TRÊN DÃY SỐ</h3>
                </th>
            </thead>
            <tr>
                <td>Nhập số phần tử:</td>
                <td><input colspan="2" type="text" name="n" value="<?php echo $n; ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1"><input type="submit"  value="Phát sinh và tính toán" name="tinh" /></td>
            </tr>
            
            <tr>
                <td>Mãng:</td>

                <td><input colspan="4" type="text" value="<?php echo $string;  ?>" disabled /></td>

            </tr>
            <tr>
                <td>Giá trị lớn nhất:</td>

                <td><input colspan="1" type="text" value="<?php echo $max;  ?>" disabled /></td>

            </tr>
            <tr>
                <td>Giá trị nhỏ nhất:</td>

                <td><input colspan="1" type="text" value="<?php echo $min;  ?>" disabled /></td>

            </tr>
            <tr>
                <td>Tổng mãng:</td>

                <td><input colspan="1" type="text" value="<?php echo $sum;  ?>" disabled /></td>

            </tr>

            <tr>
                <td colspan="2" align="center">Các phần tử của mãng có giá trị từ 0 đến 20</td>
            </tr>


        </table>



    </form>




</body>



</html>