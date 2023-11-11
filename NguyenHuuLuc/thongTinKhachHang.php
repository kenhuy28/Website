<?php include '../templates/header.php'; ?>
<style>
    .link {
        color: blue;
    }
</style>
<?php
// Ket noi CSDL
require("connect.php");

$sql = 'SELECT * from khach_hang';

$result = mysqli_query($conn, $sql);



echo "<p align='center'><font size='5' color='blue'> THÔNG TIN KHÁCH HÀNG</font></P>";

echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

echo '<tr>
    <th width="50">STT</th>
     <th width="150">Mã khách hàng</th>

    <th width="200">Tên khách hàng</th>
    <th width="100">Giới tính</th>
    <th width="300">Địa chỉ</th>
    <th width="150">Số điện thoại</th>
    <th width="50">Xóa</th>
    <th width="50">Sửa</th>
</tr>';


if (mysqli_num_rows($result) <> 0) {
    $stt = 0;

    while ($rows = mysqli_fetch_row($result)) {
        if ($stt % 2 == 0) {
            echo "<tr style=' background-color: #fee0c1;'>";
            echo "<td align=\"center\" >$stt</td>";
            echo "<td>$rows[0]</td>";
            echo "<td>$rows[1]</td>";
            if ($rows[2] == 1) {
                echo "<td align='center'><img src='female.png' width='50' height='50'></td>";
            } else {
                echo "<td align='center'><img src='male.jpg' width='50' height='50'></td>";
            }
            echo "<td>$rows[3]</td>";
            echo "<td>$rows[4]</td>";
            echo "<td><a  href='edit_kh.php?id=$rows[0]'><p class=\"link\">Sửa</p></a></td>";
            echo "<td><a href='delete_kh.php?id=$rows[0]'><p class=\"link\">Xóa</p></a></td>";
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td align=\"center\">$stt</td>";

            echo "<td>$rows[0]</td>";

            echo "<td>$rows[1]</td>";

            if ($rows[2] == 1) {
                echo "<td align='center'><img src='female.png' width='50' height='50'></td>";
            } else {
                echo "<td align='center'><img src='male.jpg' width='50' height='50'></td>";
            }
            echo "<td>$rows[3]</td>";
            echo "<td>$rows[4]</td>";
            echo "<td><a href='edit_kh.php?id=$rows[0]'><p class=\"link\">Sửa</p></a></td>";
            echo "<td><a href='delete_kh.php?id=$rows[0]'><p class=\"link\">Xóa</p></a></td>";
            echo "</tr>";
        }
        $stt += 1;

    }

}

echo "</table>";

?>
<button type="button" onclick="window.history.go(-1);">Quay lại</button>
<?php include '../templates/footer.php' ?>