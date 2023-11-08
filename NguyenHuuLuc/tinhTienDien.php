<?php
include '../templates/header.php';

$thanhToan = 0;
$chuHo;
$csc;
$csm;
$donGia;

if (isset($_POST["tinh"])) {
    if (!empty($_POST["chuHo"]) && !empty($_POST["csc"]) && !empty($_POST["csm"])) {
        $chuHo = $_POST["chuHo"];
        $csc = (int) $_POST["csc"];
        $csm = (int) $_POST["csm"];
        $donGia = (int) $_POST["donGia"];

        if ($csc > $csm) {
            echo "<script>alert(\"Chỉ số mới < chỉ số cũ\");</script>";
        } else {
            $thanhToan = ($csm - $csc) * $donGia;
        }
    } else {
        echo "<script>alert(\"Hãy điền đủ thông tin\");</script>";
    }
}
?>

<head>
    <title>Tính tiền điện</title>
    <link rel="stylesheet" href="table.css">
</head>

<body style="height: 100px">
    <form method="post">
        <table>
            <thead align="center">
                <th colspan="2" align="center">
                    <h3>THANH TOÁN TIỀN ĐIỆN</h3>
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>Tên chủ hộ:</td>
                    <td><input type="text" name="chuHo" value="<?php if (!empty($chuHo))
                        echo $chuHo; ?>"></td>
                </tr>
                <tr>
                    <td>Chỉ số cũ:</td>
                    <td><input type="text" name="csc" value="<?php if (!empty($csc))
                        echo $csc; ?>"> (Kw)
                    </td>
                </tr>
                <tr>
                    <td>Chỉ số mới:</td>
                    <td><input type="text" name="csm" value="<?php if (!empty($csm))
                        echo $csm; ?>"> (Kw)
                    </td>
                </tr>
                <tr>
                    <td>Đơn giá:</td>
                    <td><input type="text" name="donGia" value="<?php if (!empty($donGia))
                        echo $donGia;
                    else
                        echo 2000; ?>"> (VNĐ)
                    </td>
                </tr>
                <tr>
                    <td>Số tiền thanh toán:</td>
                    <td><input type="text" name="thanhToan" value="<?php
                    echo $thanhToan; ?>" disabled> (VNĐ)
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="2"><input type="submit" value="Tính" name="tinh"></td>
                </tr>
            </tbody>
        </table>
</body>

</html>
<?php include '../templates/footer.php' ?>