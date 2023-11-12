<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
    if (isset($_POST['a'])) {
        $a = trim($_POST['a']);
    } else
        $a = 0;
    if (isset($_POST['b'])) {
        $b = trim($_POST['b']);
    } else
        $b = 0;
    if (isset($_POST['sum'])) {
        $sum = trim($_POST['sum']);
    } else
        $sum = 0;
    if (isset($_POST['phepTinh'])) {
        $phepTinh = trim($_POST['phepTinh']);
    } else
        $phepTinh = 0;
    if (isset($_POST['tinh'])) {
        if ($phepTinh == "+") {
            $sum = $a + $b;
        } elseif ($phepTinh == "-") {
            $sum = $a - $b;
        } elseif ($phepTinh == "*") {
            $sum = $a * $b;
        } elseif ($phepTinh == "/") {
            $sum = $a / $b;
        }
    }
    ?>
    <form align='center' action="" method="post">
        <table>

            <thead>

                <th colspan="2" align="center">
                    <h3>PHÉP TÍNH 2 SỐ</h3>
                </th>

            </thead>
            <tr>
                <td>CHỌN PHÉP TÍNH</td>
                <td>
                    <input type="radio" name="phepTinh" value="+" checked>Cộng
                    <input type="radio" name="phepTinh" value="-">Trừ
                    <input type="radio" name="phepTinh" value="*">Nhân
                    <input type="radio" name="phepTinh" value="/">Chia
                </td>
            </tr>
            <tr>
                <td>SỐ THỨ NHẤT</td>

                <td><input type="text" name="a" value="<?php echo $a; ?> " /></td>

            </tr>
            <tr>
                <td>SỐ THỨ HAI:</td>

                <td><input type="text" name="b" value="<?php echo $b; ?> " /></td>

            </tr>
            <tr>
                <td>KẾT QUẢ:</td>
                <td><input type="text" name="sum" disabled="disabled" value="<?php echo $sum; ?> " /></td>

            </tr>
            <tr>



                <td colspan="2" align="center"><input type="submit" value="TÍNH" name="tinh" /></td>



            </tr>



        </table>



    </form>
</body>

</html>
<?php include '../templates/footer.php' ?>