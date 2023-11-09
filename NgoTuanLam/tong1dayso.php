<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Tập 4</title>
</head>

<body>
    <?php
    if (isset($_POST['n'])) {
        $n = trim($_POST['n']);
    } else
        $n = "";

    $kq = 0;
    for ($i = 0; $i < strlen($n); $i++) {
        if ($n[$i] != ',') {
            $kq = $kq + $n[$i];
        }
    }
    ?>
    <form action="" method="post">

        <table border="0" cellpadding="0">

            <th colspan="2">
                <h2>NHẬP VÀ TÍNH TRÊN DÃY SỐ</h2>
            </th>
            <tr>
                <td>Nhập Dãy Số:</td>
                <td><input type="text" name="n" size="30" value="<?php echo $n; ?> " /></td>

            </tr>
            <tr>
                <td>Kết quả:</td>
                <td><input disabled="disable" type="text" name="kq" size="30" value="<?php echo $kq; ?> " /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="tinh" size="20" value="   XỬ LÝ  " /></td>
            </tr>
            <i>(*) Các số ngăn cách với nhau bởi dấu ","</i>

        </table>
    </form>
</body>

</html>

<?php include '../templates/footer.php' ?>