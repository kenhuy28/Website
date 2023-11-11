<?php include("../templates/header.php") ?>
<?php
$phepTinh = "";
$ketQua = 0;
$so1 = intval($_POST['a']);
$so2 = intval($_POST['b']);

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
<table style="font-size: 20px;">
    <thead>
        <th colspan="2" align="center">
            <h1 style="color: cornflowerblue;">Phép tính trên 2 số</h1>
        </th>
    </thead>
    <tr>
        <td style="color: brown;"><b>Chọn phép tính : </b> </td>
        <td style=" color: red;">
            <b>
                <?php echo $phepTinh; ?>
            </b>
        </td>
    </tr>
    <tr>
        <td style="color: cornflowerblue; text-align: right;"> <b>Số 1 :</b> </td>
        <td><input type="text" readonly name="a" value="<?php echo $so1; ?>" /></td>
    </tr>
    <tr>
        <td style="color: cornflowerblue; text-align: right;"> <b>Số 2 :</b> </td>
        <td><input type="text" readonly name="b" value="<?php echo $so2; ?>" /></td>
    </tr>
    <tr>
        <td style="color: cornflowerblue; text-align: right;"> <b>Kết quả : </b></td>
        <td><input type="text" readonly name="b" value="<?php echo $ketQua; ?>" /></td>
    </tr>
    <tr>
        <td></td>
        <td> <a href="cd3bt23pheptinh.php">Quay lại trang trước</a> </td>

    </tr>

</table>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>