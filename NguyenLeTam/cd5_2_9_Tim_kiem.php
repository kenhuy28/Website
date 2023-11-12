<?php include("../templates/header.php") ?>
<style>
  .tenSP {
    font-size: 30px;
    padding: 10px;
    text-align: center;
  }

  .giaSP {
    text-align: center;
    font-size: 15px;
    font-weight: bolder;
  }

  .hinhsua {
    width: 130px;
    height: 150px;
    margin: 5px;
  }


  .otd {
    border: 1px black solid;
    margin: 10px;
    padding: 5px;
  }
</style>
</head>

<?php
// Ket noi CSDL
//require("connect.php");

$rowsPerPage = 2; //số mẩu tin trên mỗi trang 
if (!isset($_GET['page'])) {
  $_GET['page'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['page'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua') or die('Could not connect to MySQL: ' . mysqli_connect_error());
$sql = "select * from sua ";
if (isset($_POST["timTen"])) {
  $ten = $_POST["timTen"];
  $sql .= " WHERE sua.Ten_sua LIKE '%$ten%'";
} elseif (isset($_GET["timTen"])) {
  $ten = $_GET["timTen"];
  $sql .= " WHERE sua.Ten_sua LIKE '%$ten%'";
}
$sql .= " LIMIT $offset,$rowsPerPage";
$result = mysqli_query($conn, $sql);
echo "<br> <p align='center'><font size='6'> TÌM KIẾM THÔNG TIN SỮA</font></p>";

?>
<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>
  <tr>
    <td colspan="2">
      <form action="" style="margin: 5px;" method="post">
        <div style="display: inline-block; text-align: center; width: 100%;">Tên sữa
          <input type="text" name="timTen" style="width: 30%;" value="<?php if (isset($ten))
            echo $ten ?>">
            <button type="submit" name="timKiem">Tìm kiếm</button>
          </div>
        </form>
      </td>
    </tr>
    <?php
          if (mysqli_num_rows($result) <> 0) {
            $stt = 1;
            while ($rows = mysqli_fetch_row($result)) {
              echo "<tr>";
              echo "<td id='otd' colspan='2' class='tenSP'>$rows[1]</td>";
              echo "</tr>";

              echo "<td id='otd' ><img class='hinhsua' src='./Hinh_sua/{$rows[8]}'></td>";
              echo "<td>";
              echo "
        <p>
            <b>Thành phần dinh dưỡng:</b><br>
              $rows[6] 
          </p>
          <p>
            <b>Lợi ích:</b><br>
             $rows[7] 
          </p>
          <span style='float: left;'>
            <b>Trọng lượng: </b>$rows[4]gr&nbsp;-&nbsp;
            <b>Đơn giá:</b>
             $rows[5] 
          </span>";

              echo "</td>";
              echo "</tr>";
              $stt += 1;
            } //while
          }
          ?>

</table>
<?php


$re = mysqli_query($conn, $sql);
//tổng số mẩu tin cần hiển thị
$numRows = mysqli_num_rows($re);
//tổng số trang
$maxPage = floor($numRows / $rowsPerPage) + 1;
echo '<div style="text-align: center; margin-top:15px;">';
echo "<a  style='color: black; text-decoration: none;'  href=" . $_SERVER['PHP_SELF'] . "?page=1" . (isset($ten) ? "&timTen=$ten" : "") . "><<&nbsp;&nbsp;&nbsp;</a> ";

if ($_GET['page'] > 1)
  echo "<a style='color: black; text-decoration: none;'  href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . (isset($ten) ? "&timTen=$ten" : "") . "><&nbsp;&nbsp;</a> ";

for ($i = 1; $i <= $maxPage; $i++) {
  if ($i == $_GET['page'])
    echo '<b> ' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
  else
    echo "<a style='color: black; text-decoration: none;'  href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . (isset($ten) ? "&timTen=$ten" : "&timTen=") . "> " . $i . "</a> ";
}
if ($_GET['page'] < $maxPage)
  echo "<a  style='color: black; text-decoration: none;' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . (isset($ten) ? "&timTen=$ten" : "&timTen=") . ">&nbsp;&nbsp;></a>";
echo "<a  style='color: black; text-decoration: none;' href=" . $_SERVER['PHP_SELF'] . "?page=" . ($maxPage) . (isset($ten) ? "&timTen=$ten" : "") . ">&nbsp;&nbsp;&nbsp;>></a> ";

// echo "<br>  Tong so trang la: $maxPage ";
echo '</div>'; ?>
<br>
<br>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>