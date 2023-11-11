<?php
include '../templates/header.php';
$phepTinh = $_GET['phepTinh'];
$so1 = (int) $_GET['so1'];
$so2 = (int) $_GET['so2'];
$ketQua;
if ($phepTinh == "+") {
    $ketQua = $so1 + $so2;
} else if ($phepTinh == "-") {
    $ketQua = $so1 - $so2;
} else if ($phepTinh == "*") {
    $ketQua = $so1 * $so2;
} else {
    $ketQua = $so1 / $so2;
}
?>

<table>
    <thead align="center">
        <th colspan="2">
            <h3 style="color: blue;">PHÉP TÍNH TRÊN HAI SỐ</h3>
        </th>
    </thead>
    <tbody>
        <tr>
            <td style="color: red;">Phép tính: </td>
            <td style="color:red;">
                <?php if ($phepTinh == "+") {
                    echo "Cộng";
                } else if ($phepTinh == "-") {
                    echo "Trừ";
                } else if ($phepTinh == "*") {
                    echo "Nhân";
                } else {
                    echo "Chia";
                } ?>
            </td>
        </tr>
        <tr>
            <td style="color:blue;">Số thứ nhất:</td>
            <td>
                <input type="text" value=" <?php echo $so1; ?>">
            </td>
        </tr>
        <tr>
            <td style="color:blue;">Số thứ hai:</td>
            <td>
                <input type="text" value=" <?php echo $so2; ?>">
            </td>
        </tr>
        <tr>
            <td style="color:blue;">Kết quả:</td>
            <td>
                <input type="text" value=" <?php echo $ketQua; ?>">
            </td>
        </tr>
        <tr>
            <td></td>
            <td><a href="javascript:history.go(-1);" style="color:blue;"><i>Quay lại trang trước</i></a></td>
        </tr>
    </tbody>
</table>
<button type="button" onclick="window.history.go(-1);">Quay lại</button>
<?php include '../templates/footer.php' ?>