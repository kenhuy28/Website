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

  $sql = 'select Ma_khach_hang,Ten_khach_hang,Phai,Dia_chi,Dien_thoai from khach_hang';

  $result = mysqli_query($conn, $sql);



  echo "<p align='center'><font size='5' color='blue'> THÔNG TIN KHÁCH HÀNG</font></P>";

  echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
  echo '<tr>

    <th width="20">Mã KH</th>

    <th width="100">Tên Khách hàng</th>

    <th width="20">Giới tính</th>

    <th width="150">Địa chỉ</th>
    <th width="50">Số điện thoại</th>

</tr>';


  $stt = 1;
  if (mysqli_num_rows($result) <> 0) {

    while ($rows = mysqli_fetch_row($result)) {
      echo "<tr style='background-color: " . (($stt % 2 == 0) ? "antiquewhite;'" : "white;'") . ">";


      echo "<td align='center' >$rows[0]</td>";

      echo "<td>$rows[1]</td>";

      echo "<td align='center' >" . (($rows[2] == 1) ? '<img style="width:35px; " src="male.png" alt="">' : '<img style="width:35px; " src="female.png" alt="">' ) . "</td>";
      echo "<td>$rows[3]</td>";
      echo "<td>$rows[4]</td>";

      echo "</tr>";
      $stt++;

    }

  }

  echo "</table>";

  ?>

</body>

</html>