<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>THANH TOÁN TIỀN ĐIỆN</title>

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
    if (isset($_POST['ten'])) {
        $ten = trim($_POST['ten']);
    } else
        $ten = "Nhập vào tên";
    if (isset($_POST['a'])) {
        $a = trim($_POST['a']);
    } else
        $a = 0;
    if (isset($_POST['b'])) {
        $b = trim($_POST['b']);
    } else
        $b = 0;
    if (isset($_POST['value'])) {
        $value = trim($_POST['value']);
    } else
        $value = 0;
    if (isset($_POST['tinh'])) {
        $sum = ($b - $a) * $value;
    } else
        $sum = 0;
    ?>
    <form align='center' action="" method="post">
        <table>

            <thead>

                <th colspan="2" align="center">
                    <h3>THANH TOÁN TIỀN ĐIỆN</h3>
                </th>

            </thead>

            <tr>
                <td>Tên chủ hộ:</td>

                <td><input type="text" name="ten" value="<?php echo $ten; ?> " /></td>

            </tr>

            <tr>
                <td>Chi số cũ:</td>

                <td><input type="text" name="a" value="<?php echo $a; ?> " /></td>

            </tr>
            <tr>
                <td>Chi số mới:</td>

                <td><input type="text" name="b" value="<?php echo $b; ?> " /></td>

            </tr>
            <tr>
                <td>Số tiền thanh toán:</td>

                <td><input type="text" name="value" value="<?php echo $value; ?> " /></td>

            </tr>
            <tr>
                <td>Tiền thanh toán:</td>



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