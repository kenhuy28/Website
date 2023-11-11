<?php
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua');
mysqli_set_charset($conn, 'UTF8');
$rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['page'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
$result = mysqli_query($conn, "SELECT Ma_sua, ten_sua, Trong_luong,Don_gia,Hinh FROM sua LIMIT  $offset , $rowsPerPage");
// $sql = "select Ma_sua,ten_sua,Trong_luong,Don_gia from sua";
// $result = mysqli_query($conn, $sql);
echo "<table align='center' width='1000' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
echo " <thead>

    <th colspan='5' align='center'>
        <h1>THÔNG TIN CÁC SẢN PHẨM</h1>
    </th>
    </thead>";
if (mysqli_num_rows($result) <> 0) {
    $dem = 0;
    while ($rows = mysqli_fetch_row($result)) {
        if($dem == 5) {
            echo "<tr>";
        }
        echo "<td width='200'><a href='2_7.php?id=$rows[0]'><h4 style = 'margin: 0;' align='center' >$rows[1]</h4></a><br> <p align='center'> $rows[2]gr - $rows[3]VND</p> <br> <div align='center'> <img align='center' src='../../16-10/Hinh_sua/$rows[4]' width='100' height='100'></div></td>";
        if($dem == 10) {
            echo "</tr>";
        }
        $dem++;
    } 
}
echo "</table>";
$re = mysqli_query($conn, 'select * from sua');
//tổng số mẩu tin cần hiển thị
$numRows = mysqli_num_rows($re);
//tổng số trang
$maxPage = floor($numRows / $rowsPerPage) + 1;
echo "<h3 align='center'>";
if ($_GET['page'] > 1) {
    echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . (1) . "><<</a> ";
    echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "><</a> ";

}
for ($i = 1; $i <= $maxPage; $i++) {
    if ($i == $_GET['page']) {
        echo '<b>' . $i . '   </b> '; //trang hiện tại sẽ được bôi đậm
    } else
        echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . ">" . $i . "</a> ";
}
if ($_GET['page'] < $maxPage) {
    echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . ">></a>";
    echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($maxPage) . ">>></a>";
}

echo "</h3>";
?>