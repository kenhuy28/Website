<?php
include '../templates/header.php';

$dienTich = 0;
$chieuDai;
$chieuRong;

if (!empty($_POST["chieuDai"]) && !empty($_POST["chieuRong"])) {
    $chieuDai = (int) $_POST["chieuDai"];
    $chieuRong = (int) $_POST["chieuRong"];
    $dienTich = $chieuDai * $chieuRong;
}
?>

<head>
    <title>Tính diện tích hình chữ nhật</title>
    <link rel="stylesheet" href="table.css">
</head>

<body style="height: 100px">
    <form method="post">
        <table>
            <thead align="center">
                <th colspan="2" align="center">
                    <h3>DIỆN TÍCH HÌNH CHỮ NHẬT</h3>
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>Chiều dài:</td>
                    <td><input type="text" name="chieuDai" value="<?php if (!empty($chieuDai))
                        echo $chieuDai; ?>"></td>
                </tr>
                <tr>
                    <td>Chiều rộng:</td>
                    <td><input type="text" name="chieuRong" value="<?php if (!empty($chieuRong))
                        echo $chieuRong; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Diện tích:</td>
                    <td><input type="text" name="dienTich" value="<?php
                    echo $dienTich; ?>" disabled>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="2"><input type="submit" value="Tính" name="tinh"></td>
                </tr>
            </tbody>
        </table>

        <?php

        if (isset($_POST["Name"]))

            print "Hello " . $_POST["Name"];

        ?>
</body>

</html>
<?php include '../templates/footer.php' ?>