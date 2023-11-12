<?php include("../templates/header.php") ?>

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

  table {
    max-width: 600px;
    border-collapse: collapse;
  }

  td {
    border: 1px black solid;
    margin: 10px;
  }

  .tensua {
    font-family: fantasy;

  }
</style>
</head>

  <?php
  // Ket noi CSDL
  //require("connect.php");
  if (isset($_GET['ma_sua']))
    $ma_sua = $_GET['ma_sua'];
  $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Could not connect to MySQL: ' . mysqli_connect_error());
  $sql = "select * from sua  where Ma_sua='$ma_sua'";
  $result = mysqli_query($conn, $sql);
  $ttsua = mysqli_fetch_assoc($result);
  ?>
  <form action="2_6_7_List_dang_cot_co_link.php" method="get">
    <table>
      <tr>
        <td colspan="2" class="tensua" style="text-align: center;">
          <?php echo $ttsua['Ten_sua'] ?>
        </td>
      </tr>
      <tr>
        <td><img class="hinhsua" src="./Hinh_sua/<?php echo $ttsua['Hinh'] ?> " alt=""></td>
        <td>
          <p>
            <b>Thành phần dinh dưỡng:</b><br>
            <?php echo $ttsua['TP_Dinh_Duong'] ?>
          </p>
          <p>
            <b>Lợi ích:</b><br>
            <?php echo $ttsua['Loi_ich'] ?>
          </p>
          <span style="float: right;">
            <b>Trọng lượng:</b>
            <?php echo $ttsua['Trong_luong'] ?>&nbsp;gr&nbsp;-&nbsp;
            <b>Đơn giá:</b>
            <?php echo $ttsua['Don_gia'] ?>
          </span>
        </td>
      </tr>
      <tr hidden>
        <td>
          <input type="text" name="page" value="<?php echo $_GET['page']; ?> ">
        </td>
        <td></td>
      </tr>
    </table>
  </form>
  <br>
  <?php include("back.php") ?>
  <?php include("../templates/footer.php") ?>