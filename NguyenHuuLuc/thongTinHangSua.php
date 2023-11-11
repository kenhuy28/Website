<?php include '../templates/header.php'; ?>

<?php
// Ket noi CSDL
require("connect.php");

$sql = 'select * from hang_sua';

$result = mysqli_query($conn, $sql);



echo "<p align='center'><font size='5' color='blue'> THÔNG TIN HÃNG SỮA</font></P>";

echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

echo '<tr>

    <th width="20">STT</th>

    <th width="90">Mã hãng sữa</th>

    <th width="100">Tên hãng sữa</th>

    <th width="200">Địa chỉ</th>
    <th width="100">Điện thoại</th>
    <th width="100">Email</th>

</tr>';



if (mysqli_num_rows($result) <> 0) {
    $stt = 1;

    while ($rows = mysqli_fetch_assoc($result)) {
        echo "<tr>";

        echo "<td align='center' >$stt</td>";

        echo "<td align='center' >{$rows["Ma_hang_sua"]}</td>";

        echo "<td>{$rows["Ten_hang_sua"]}</td>";
        echo "<td>{$rows["Dia_chi"]}</td>";

        echo "<td>{$rows["Dien_thoai"]}</td>";
        echo "<td>{$rows["Email"]}</td>";

        echo "</tr>";

        $stt += 1;

    }

}

echo "</table>";

?>
<button type="button" onclick="window.history.go(-1);">Quay lại</button>
<?php include '../templates/footer.php' ?>