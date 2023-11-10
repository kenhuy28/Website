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

        h3 {
            font-family: verdana;
            text-align: center;
            /* text-anchor: middle; */
            color: #ff8100;
            font-size: medium;
        }

        .sotien {
            color: black;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_POST['chiSoCu']) && isset($_POST['chiSoMoi']) && isset($_POST['donGia']))
        $flag = true;
    else
        $flag = false;
    $soTien = 0;
    //todo kiểm tra các đầu vào
    if (isset($_POST['tenChuHo']))
        $tenChuHo = trim($_POST['tenChuHo']);
    else
        $tenChuHo = "";
    if (isset($_POST['chiSoCu']))
        $chiSoCu = trim($_POST['chiSoCu']);
    else
        $chiSoCu = "";
    if (isset($_POST['chiSoMoi']))
        $chiSoMoi = trim($_POST['chiSoMoi']);
    else
        $chiSoMoi = "";
    if (isset($_POST['donGia']))
        $donGia = trim($_POST['donGia']);
    else
        $donGia = "";
    if ($flag)
        $soTien = ((int) $chiSoMoi - (int) $chiSoCu) * (int) $donGia;
    ?>
    <form action="" method="POST">
        <table>
            <thead>
                <th colspan="3" style="text-align: center;">
                    <h3>Thanh toán tiền điện</h3>
                </th>
            </thead>
            <tr>
                <td> Tên chủ hộ: </td>
                <td><input type="text" name="tenChuHo" value="<?php echo $tenChuHo; ?>" /></td>
            </tr>
            <tr>
                <td> Chỉ số cũ: </td>
                <td><input type="text" name="chiSoCu" value="<?php echo $chiSoCu; ?>" /></td>
                <td>(kW)</td>
            </tr>
            <tr>
                <td> Chỉ số mới: </td>
                <td><input type="text" name="chiSoMoi" value="<?php echo $chiSoMoi; ?>" /></td>
                <td>(kW)</td>
            </tr>
            <tr>
                <td> Đơn giá: </td>
                <td><input type="text" name="donGia" value="20000" /></td>
                <td>(VNĐ)</td>
            </tr>
            <tr>
                <td> Số tiền thanh toán:</td>
                <td><input type="text" name="soTien" disabled value="<?php echo $soTien; ?>"></td>
                <td>(VNĐ)</td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="tinh" value="Tính" /></td>
            </tr>
        </table>
    </form>
</body>

</html>