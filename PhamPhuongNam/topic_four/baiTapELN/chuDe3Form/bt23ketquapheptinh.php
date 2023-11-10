<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>tinh dien tich HCN</title>

</head>

<body>
    <?php
    $phepTinh = "";
    $ketQua = 0;
    $so1 = $_POST['a'];
    $so2 = $_POST['b'];


    switch ($_POST['radPT']) {
        case 'cong':
            $phepTinh = "Cộng";
            $ketQua = $so1 + $so2;

            break;
        case 'tru':
            $phepTinh = "Trừ";
            $ketQua = $so1 - $so2;

            break;
        case 'nhan':
            $phepTinh = "Nhân";
            $ketQua = $so1 * $so2;

            break;
        case 'chia':
            $phepTinh = "Chia";
            $ketQua = round($so1 / $so2, 2);

            break;
    }
    ?>

    <table>
        <thead>
            <th colspan="2" align="center">
                <h1>Phép tính trên 2 số</h1>
            </th>

        </thead>
        <tr>
            <td> Chọn phép tính: </td>
            <td>
                <?php echo $phepTinh;
                ?>
            </td>
        </tr>
        <tr>
            <td> Số thứ nhất: </td>
            <td><input type="text" name="a" value="<?php echo $so1; ?>" /></td>
        </tr>
        <tr>
            <td> Số thứ hai: </td>
            <td><input type="text" name="b" value="<?php echo $so2; ?>" /></td>
        </tr>
        <tr>
            <td> Kết quả: </td>
            <td><input type="text" name="b" value="<?php echo $ketQua; ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td> <a href="pheptinh.php">Quay lại trang trước</a>
            </td>

        </tr>

    </table>


</body>

</html>