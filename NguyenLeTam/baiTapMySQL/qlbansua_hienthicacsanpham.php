<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title>Thông tin sữa</title>

</head>

<body>

  <?php



  // Ket noi CSDL
  
  //require("connect.php");
  
  $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')

    or die('Could not connect to MySQL: ' . mysqli_connect_error());

  $sql = 'select Ten_sua, Trong_luong, Don_gia, Hinh, Ten_Loai, Ten_hang_sua from sua join loai_sua on sua.Ma_loai_sua=loai_sua.Ma_loai_sua join hang_sua on sua.Ma_hang_sua=hang_sua.Ma_hang_sua';

  $result = mysqli_query($conn, $sql);



  echo "<p align='center'><font size='5' color='blue'> THÔNG TIN CÁC SẢN PHẨM</font></P>";

  echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

  echo '<tr hidden>

    <th width="100"></th>

    <th width="100"></th>

</tr>';


  // select Ten_sua, Trong_luong, Don_gia, Hinh, Ten_Loai, Ten_hang_sua from sua join loai_sua on sua.Ma_loai_sua=loai_sua.Ma_loai_sua join hang_sua on sua.Ma_hang_sua=hang_sua.Ma_hang_sua
  if (mysqli_num_rows($result) <> 0) {
    $stt = 1;

    while ($rows = mysqli_fetch_row($result)) {
      echo "<tr>";

      echo "<td align='center' ><img style='width: 100px; height: 100px; margin: 5px;'  src='Hinh_sua/$rows[3]'></td>";
      echo "<td align='left' >
      
      <div>
        <p><b>$rows[0]</b></p>
        Nhà sản xuất: $rows[5]<br> 
        $rows[4] - $rows[1] - $rows[2] VNĐ
      </div>
      
      </td>";

      echo "</tr>";

      $stt += 1;

    }

  }

  echo "</table>";

  ?>
 
</body>

</html>