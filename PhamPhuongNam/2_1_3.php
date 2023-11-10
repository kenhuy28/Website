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
    $sum = 0;
    if (isset($_POST['name'])) {
        $name = trim($_POST['name']);
    } else {
        $name = "";
    }
    function Sum(&$sum, $string){
        if($string == "") {
            $sum =0;
        } else {
            $arr = [];
            $arr = explode(",",$string);
            foreach ($arr as $number) {
                $sum += (int)$number;
            }
        }
    }

    Sum($sum,$name);
    ?>

    <form align='center' action="3.php" method="post">

        <table>
            <thead>

                <th colspan="3" align="center">
                    <h3>NHẬP VÀ TÍNH TRÊN DÃY SỐ</h3>
                </th>
            </thead>
            <tr>
                <td>Nhập dãy số:</td>

                <td><input colspan="2" type="text" name="name" value="<?php echo $name; ?>" /></td>
                <td>(*)</td>


            </tr>
            <tr>
                <td></td>
                <td colspan="2"><input type="submit" value="Tính tổng dãy số" name="tinh" /></td>
            </tr>
            
            <tr>
                <td>Tổng dãy số dãy số:</td>

                <td><input colspan="2" type="text" value="<?php echo $sum;  ?>" disabled /></td>

            </tr>
            <tr>
                <td colspan="3" align="center">Các dãy số cách nhau bằng dấu ,</td>
            </tr>


        </table>



    </form>




</body>



</html>