<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>tinh dien tich HCN</title>
    <style type="text/css">
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
    define("pi", 3.1415);
    if (isset($_POST['a']))
        $a = trim($_POST['a']);
    else
        $a = "";
    if (isset($_POST['b']))
        $b = trim($_POST['b']);
    else
        $b = "";
    ?>
    <form action="" method="POST">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h1>Tính chu vi và diện tích các hình cơ bản</h1>
                </th>

            </thead>
            <tr>
                <td> Nhập a: </td>
                <td><input type="text" name="a" value="<?php echo $a; ?>" /></td>
            </tr>
            <tr>
                <td> Nhập b: </td>
                <td><input type="text" name="b" value="<?php echo $b; ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="kq" value="Xử lý" /></td>
            </tr>
        </table>


    </form>
    <?php
        switch ($a) {
            case '1':
                echo "<br>Chu vi hình vuông cạnh $b là " . $b * 4;
                echo "<br>Diện tích hình vuông cạnh $b là " . $b * $b;
                break;
            case '2':
                echo "<br>Chu vi của hình tròn có bán kính $b là " . round($b * 2 * pi, 1);
                echo "<br>Diện tích của hình tròn có bán kính $b là " . pi * pow($b, 2);
                break;
            case '3':
                echo "<br>Chu vi của hình tam giác đều có cạnh  $b là " . $b * 3;
                echo "<br>Diện tích của hình tam giác đều có cạnh  $b là " . round(pow($b, 2) * sqrt(3) / 4, 1);
                break;
            case '4':
                echo "<br>Chu vi của hình chữ nhật có 2 cạnh là $a và $b" . ($a + $b) * 2;
                echo "<br>Diện tích của hình chữ nhật có 2 cạnh $a và $b là " . $a * $b;
                break;

            default:
                echo "không xác định hình";
                echo $a;
                break;
        } ?>

</body>

</html>