<?php include '../templates/header.php'; ?>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Không thể kết nối tới database' . mysqli_connect_error());
$sql = 'SELECT * FROM Khach_hang';
$result = mysqli_query($conn, $sql);
// 4.Xu ly du lieu tra ve\
echo "LẤY THÔNG TIN KHÁCH HÀNG CỦA qlbansua<br><br>";
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_array($result)) {
        for ($i = 0; $i < mysqli_num_fields($result); $i++) {
            echo $row[$i] . " <br>";
        }

    }
}
mysqli_free_result($result);
mysqli_close($conn);
?>
<?php include '../templates/footer.php' ?>