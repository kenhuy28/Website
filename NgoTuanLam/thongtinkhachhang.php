<?php include '../templates/header.php'; ?>
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

    $sql = 'select Ma_khach_hang ,Ten_khach_hang, Phai ,Dia_chi,Dien_thoai from khach_hang';

    $result = mysqli_query($conn, $sql);



    echo "<p align='center'><font size='5' color='blue'> THÔNG TIN KHÁCH HÀNG QLBANSUA</font></P>";

    echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

    echo '<tr>


     <th width="50">Mã kh</th>

    <th width="150">Tên kh</th>
    
    <th width="50">Phai</th>

    <th width="200">Dia chi</th>
    <th width="200">SDT</th>

</tr>';



    if (mysqli_num_rows($result) <> 0) {
        $stt = 1;

        while ($rows = mysqli_fetch_row($result)) {
            if ($stt % 2 == 0) {
                echo "<tr style = 'background-color:red;'>";

            } else
                echo "<tr>";

            echo "<td>$rows[0]</td>";

            echo "<td>$rows[1]</td>";

            if ($rows[2] == 1) {
                echo "<td><img src='nam.png' width=30px     ></td>";
            } else {
                echo "<td><img src='nu.jpg' width=30px ></td>";
            }
            echo "<td>$rows[3]</td>";
            echo "<td>$rows[4]</td>";

            echo "</tr>";

            $stt += 1;

        }


    }

    echo "</table>";

    ?>

</body>

</html>

<?php include '../templates/footer.php' ?>