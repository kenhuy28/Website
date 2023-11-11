<?php include("../templates/header.php") ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tính diện tích HCN</title>
    <style type="text/css">
        table {
            background: #fff4d4;
            border: 0 solid yellow;
        }

        thead {
            background: #f7d767;
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
                    <h3 style="padding-top: 10px; margin-bottom: 5px; font-size: 22px;">THANH TOÁN TIỀN ĐIỆN</h3>
                </th>
            </thead>
            <tr>
                <td> Tên chủ hộ: </td>
                <td><input type="text" name="tenChuHo" value="<?php echo $tenChuHo; ?>" /></td>
            </tr>
            <tr>
                <td> Chỉ số cũ: </td>
                <td><input type="number" min="0" name="chiSoCu" value="<?php echo $chiSoCu; ?>" /></td>
                <td>(kW)</td>
            </tr>
            <tr>
                <td> Chỉ số mới: </td>
                <td><input type="number" min="0" name="chiSoMoi" value="<?php echo $chiSoMoi; ?>" /></td>
                <td>(kW)</td>
            </tr>
            <tr>
                <td> Đơn giá: </td>
                <td><input type="number" min="0" name="donGia" value="20000" /></td>
                <td>(VNĐ)</td>
            </tr>
            <tr>
                <td> Số tiền thanh toán:</td>
                <td><input type="text" name="soTien" readonly value="<?php echo $soTien; ?>"></td>
                <td>(VNĐ)</td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Tính</button></td>
            </tr>
        </table>
    </form>
</body>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>