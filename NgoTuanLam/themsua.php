<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Them sua</title>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "qlbansua");
    mysqli_set_charset($conn, "UTF8");
    if (!empty($_POST["maSua"])) {
        $maSua = $_POST["maSua"];
    } else
        $maSua = "";
    if (!empty($_POST["tenSua"])) {
        $tenSua = $_POST["tenSua"];
    } else
        $tenSua = "";
    if (!empty($_POST["hangSua"])) {
        $hangSua = $_POST["hangSua"];
    } else
        $hangSua = "";
    if (!empty($_POST["loaiSua"])) {
        $loaiSua = $_POST["loaiSua"];
    } else
        $loaiSua = "";
    if (!empty($_POST["trongLuong"])) {
        $trongLuong = $_POST["trongLuong"];
    } else
        $trongLuong = "";
    if (!empty($_POST["donGia"])) {
        $donGia = $_POST["donGia"];
    } else
        $donGia = "";
    ?>
    <form action="themsua.php" method="POST" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td colspan="2" align="center">
                    <h3 style="color:red;">THÊM SỮA</h3>
                </td>
            </tr>
            <tr>
                <td>
                    MaSua
                </td>
                <td>
                    <input type="text" name="maSua" value="<?php echo $maSua ?>">
                </td>
            </tr>
            <tr>
                <td>
                    tenSua
                </td>
                <td>
                    <input type="text" name="tenSua" value="<?php echo $tenSua ?>">
                </td>
            </tr>
            <tr>
                <td>
                    HangSua
                </td>
                <td>
                    <select name="hangSua" id="">
                        <option value="">NutiFood</option>
                        <option value="">Vinamilk</option>
                        <option value="">Mead Jonhson</option>
                        <option value="">Daisy</option>
                        <option value="">Dumex</option>
                        <option value="">Dutch Lady</option>
                        <option value="">Abbott</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    LoaiSua
                </td>
                <td>
                    <select name="loaiSua" id="">
                        <option value="">Sữa bột</option>
                        <option value="">Sữa chua</option>
                        <option value="">Sữa đặc</option>
                        <option value="">Sữa tươi</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    TrongLuong
                </td>
                <td>
                    <input type="text" name="trongLuong" value="<?php echo $trongLuong ?>">
                </td>
            </tr>
            <tr>
                <td>
                    DonGia
                </td>
                <td>
                    <input type="text" name="donGia" value="<?php echo $donGia ?>">
                </td>
            </tr>
            <tr>
                <td>
                    ThanhPhanDD
                </td>
                <td>
                    <textarea name="thanhPhanDD" id="" cols="30" rows="10"
                        value="<?php echo $thanhPhanDD ?>"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    LoiIch
                </td>
                <td>
                    <textarea name="loiIch" id="" cols="30" rows="10" value="<?php echo $loiIch ?>"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="file" name="image">
                    <p>
                        <input type="submit" name="submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
<?php include '../templates/footer.php' ?>