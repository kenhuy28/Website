<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài kiểm tra số 1</title>
  <style type="text/css">
    table {
      color: #ffff00;
      background-color: gray;
      border-collapse: collapse;
    }

    table th {
      background-color: blue;
      font-style: vni-times;
      color: yellow;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 5px;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  if (isset($_POST['strDSNV'])) {
    $strDSNV = $_POST['strDSNV'];
    $strDSNV = trim( $strDSNV, "*");
    $DSNV = explode("*", $strDSNV);
    for ($i = 0; $i < sizeof($DSNV); $i++) {
      echo var_dump(json_decode($DSNV[$i]));
      echo "<br> <br>";
      $NhanVien = json_decode($DSNV[$i]);
      echo "<br><br> ";
      echo var_dump($NhanVien);
    }

  }

  if (isset($_POST['themNV'])) {
    $maNV = trim($_POST['maNV']);
    $hoTenNV = trim($_POST['hoTenNV']);
    $ngaySinh = trim($_POST['ngaySinh']);
    $phongBan = $_POST['radPB'];
    $gioiTinh = $_POST['radGT'];
    $diaChi = $_POST['diaChi'];
    $email = $_POST['email'];
    $NhanVienTemp = array($phongBan => array($maNV, $hoTenNV, $gioiTinh, $ngaySinh, $diaChi, $email));
    $strDSNV .= json_encode($NhanVienTemp, JSON_UNESCAPED_UNICODE);
    echo var_dump(json_decode($strDSNV));
  }

  ?>
  <form action="" method="post">
    <table>
      <thead>
        <th colspan="2">
          <h2 style="text-align: center; margin: auto;"> Quản lý nhân viên</h2>
        </th>
      </thead>
      <tbody>
        <tr>
          <td>
            Phòng ban:
          </td>
          <td style="display: inline-flex; border: none;">
            <input type="radio" name="radPB" value="Hành chính" <?php if (isset($_POST['radPB']) && $_POST['radPB'] == 'Hành chính')
              echo 'checked="checked"'; ?> checked />Hành chính
            <input type="radio" name="radPB" value="Kế toán" <?php if (isset($_POST['radPB']) && $_POST['radPB'] == 'Kế toán')
              echo 'checked="checked"'; ?> /> Kế toán
            <input type="radio" name="radPB" value="Nhân sự" <?php if (isset($_POST['radPB']) && $_POST['radPB'] == 'Nhân sự')
              echo 'checked="checked"'; ?> /> Nhân sự
            <input type="radio" name="radPB" value="Tiếp thị" <?php if (isset($_POST['radPB']) && $_POST['radPB'] == 'Tiếp thị')
              echo 'checked="checked"'; ?> /> Tiếp thị

          </td>
        </tr>
        <tr>
          <td>
            Mã NV:
          </td>
          <td>
            <input type="text" style="width: 300px;" name="maNV" value="<?php if (isset($_POST['maNV']))
              echo $maNV; ?>">
          </td>
        </tr>
        <tr>
          <td>
            Họ và tên:
          </td>
          <td>
            <input type="text" style="width: 300px;" name="hoTenNV" value="<?php if (isset($_POST['hoTenNV']))
              echo $hoTenNV; ?>">
          </td>
        </tr>
        <tr>
          <td>
            Giới tính:
          </td>
          <td style="display: inline-flex;  border: none;">
            <input type="radio" name="radGT" value="Nam" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nam')
              echo 'checked="checked"'; ?> checked /> Nam
            <input type="radio" name="radGT" value="Nu" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nu')
              echo 'checked="checked"'; ?> /> Nữ
          </td>
        </tr>
        <tr>
          <td>
            Ngày sinh:
          </td>
          <td>
            <input type="date" style="width: 300px;" name="ngaySinh" value="<?php if (isset($_POST['ngaySinh']))
              echo $ngaySinh; ?>">
          </td>
        </tr>
        <tr>
          <td>
            Địa chỉ:
          </td>
          <td>
            <input type="text" style="width: 300px;" name="diaChi" value="<?php if (isset($_POST['diaChi']))
              echo $diaChi; ?>">
          </td>
        </tr>
        <tr>
          <td>
            Email:
          </td>
          <td>
            <input type="email" style="width: 300px;" name="email" value="<?php if (isset($_POST['email']))
              echo $email; ?>">
          </td>
        </tr>
        <tr style="text-align: center;">
          <td colspan="2">
            <button type="submit" name="themNV">Thêm Nhân viên</button>
            <button type="submit" name="luuDSNV">Lưu Nhân viên</button>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input style="width: 300px;" type="text" name="strDSNV" value="<?php if (isset($_POST['strDSNV']))
              print htmlspecialchars($strDSNV); ?>">
          </td>
        </tr>
      </tbody>
    </table>
  </form>


  <div>
    <h2>Danh sách Nhân viên</h2>
    <table>
      <tr style="font-size: large;">
        <td>Phòng ban</td>
        <td>Mã NV</td>
        <td>Họ tên</td>
        <td>Giới tính</td>
        <td>Ngày sinh</td>
        <td>Địa chỉ</td>
        <td>Email</td>
      </tr>
      <?php
      if (isset($_POST['strDSNV'])) {
      foreach ($NhanVien as $stt => $pb) {
        echo "<tr style='font-size: large;'>";
        foreach ($pb as $sttpb => $nv) {
          echo "<td>" . $sttpb . "</td> ";
          foreach ($nv as $sttnv => $ttnv) {
            echo "<td>" . $ttnv . "</td> ";
          }
        }
        echo "</tr> ";
      }}
     if (isset($_POST['strDSNV'])) echo  $strDSNV;
      ?>
    </table>
  </div>
</body>

</html>