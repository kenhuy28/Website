<?php include("../templates/header.php") ?>

<head>
  <style>
    .tenSP {
      display: inline-block;
      white-space: normal;
      text-overflow: ellipsis;
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      /* max-height: 3.6em; */
      line-height: 1.1em;
      margin-top: 10px;
    }

    .giaSP {
      text-align: center;
      font-size: 15px;
      font-weight: bolder;
    }

    .hinhsua {
      width: 120px;
      height: 130px;
      margin: 10px;
    }
  </style>
</head>


<?php
// Ket noi CSDL
//require("connect.php");
$rowsPerPage = 15; //sốmẩutin trênmỗitrang, giảsửlà10
if (!isset($_GET['page'])) {
  $_GET['page'] = 1;
}
//vịtrícủamẩutin đầutiêntrênmỗitrang
$offset = ($_GET['page'] - 1) * $rowsPerPage;
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
  or die('Could not connect to MySQL: ' . mysqli_connect_error());
$sql = "select Ten_sua, Trong_luong, Don_gia, Hinh, Ten_Loai, Ten_hang_sua,Ma_sua from sua join loai_sua on sua.Ma_loai_sua=loai_sua.Ma_loai_sua join hang_sua on sua.Ma_hang_sua=hang_sua.Ma_hang_sua LIMIT $offset,$rowsPerPage";
$result = mysqli_query($conn, $sql);
echo "<p align='center'><font size='5' color='blue'> THÔNG TIN CÁC SẢN PHẨM</font></P>";
echo "<table align='center' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse; width:90%'>";
// echo '<tr hidden>
//   <th  style=" width:20%"></th>
//   <th  style=" width:20%"></th>
//   <th  style=" width:20%"></th>
//   <th  style=" width:20%"></th>
//   <th  style=" width:20%"></th>
// </tr>';
// select Ten_sua, Trong_luong, Don_gia, Hinh, Ten_Loai, Ten_hang_sua from sua join loai_sua on sua.Ma_loai_sua=loai_sua.Ma_loai_sua join hang_sua on sua.Ma_hang_sua=hang_sua.Ma_hang_sua
if (mysqli_num_rows($result) <> 0) {
  $stt = 1;
  while ($rows = mysqli_fetch_row($result)) {
    if ($stt % 5 == 1)
      echo "<tr>";
    echo "<td align='center' style=' width:20%'>
        <b class='tenSP'><a  style='color: blue; text-decoration: none;'  href='cd5_2_6_7_List_dang_cot_co_link_info.php?ma_sua=$rows[6]&page={$_GET['page']}'>$rows[0]</a> </b>
       <div  class='giaSP'>$rows[1] gr - $rows[2] VNĐ</div><br> 
        <img  class='hinhsua'src='Hinh_sua/$rows[3]'> 
      </td>";
    $stt += 1;
    if ($stt % 5 == 1)
      echo "</tr>";
  }
}
echo "</table>";



$re = mysqli_query($conn, 'select * from sua');
//tổng số mẩu tin cần hiển thị
$numRows = mysqli_num_rows($re);
//tổng số trang
$maxPage = floor($numRows / $rowsPerPage) + 1;
echo '<div style="text-align: center; margin-top:15px; font-size: larger;">';
if ($_GET['page'] > 1)
  echo "<a  style='color: black; text-decoration: none;' href=" . $_SERVER['PHP_SELF'] . "?page=1><<&nbsp;&nbsp;&nbsp;</a> ";

if ($_GET['page'] > 1)
  echo "<a  style='color: black; text-decoration: none;' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "><&nbsp;&nbsp;</a> ";

for ($i = 1; $i <= $maxPage; $i++) {
  if ($i == $_GET['page'])
    echo '<b>' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
  else
    echo "<a  style='color: black; text-decoration: none;' href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . "> " . $i . "</a> ";
}
if ($_GET['page'] < $maxPage)
  echo "<a  style='color: black; text-decoration: none;' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . ">&nbsp;&nbsp;></a>";
if ($_GET['page'] < $maxPage)
  echo "<a  style='color: black; text-decoration: none;' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($maxPage) . ">&nbsp;&nbsp;&nbsp;>></a> ";

// echo "<br>  Tong so trang la: $maxPage ";
echo '</div>';

?>
<br>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>