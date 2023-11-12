<?php include("../templates/header.php") ?>

<head>
  <style>
    td {
      border: 1px solid;
    }

    h1 {
      text-align: center;
      margin: 5px;
    }

    table {
      background-color: aquamarine;
    }

    #xuly {
      text-align: center;
    }

    tr {
      height: 30px;
    }

    input {
      width: 200px;
      border-radius: 4px;
    }
  </style>
</head>
<?php include "cd4bt13QLNV.inc.php" ?>
<?php
if (isset($_POST['tinhLuong'])) {
  $hoTen = trim($_POST['hoTen']);
  $gioiTinh = trim($_POST['gioiTinh']);
  $ngayVaoLam = trim($_POST['ngayVaoLam']);
  $heSoLuong = trim($_POST['heSoLuong']);
  $soCon = trim($_POST['soCon']);
  if (isset($_POST['loaiNhanVien']))
    if ($_POST['loaiNhanVien'] == "vanphong") {
      $soNgayVang = trim($_POST['soNgayVang']);
      $NVVP = new NhanVienVanPhong($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang);
      $tienLuong = $NVVP->tinhTienLuong();
      $troCap = $NVVP->tinhTroCap();
      $tienThuong = $NVVP->tinhTienThuong();
      $tienPhat = $NVVP->tinhTienPhat();
      $thucLinh = $tienLuong + $troCap + $tienThuong - $tienPhat;
    }
  if ($_POST['loaiNhanVien'] == "sanxuat") {
    $soSanPham = trim($_POST['soSanPham']);
    $NVSX = new NhanVienSanXuat($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soSanPham);
    $tienLuong = $NVSX->tinhTienLuong();
    $troCap = $NVSX->tinhTroCap();
    $tienThuong = $NVSX->tinhTienThuong();
    $thucLinh = $tienLuong + $troCap + $tienThuong;
  }
}

?>
<form action="" method="post">
  <table>
    <thead style="background-color: white;">
      <tr>
        <td colspan="4">
          <h1>
            QUẢN LÝ NHÂN VIÊN
          </h1>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Họ tên:</td>
        <td><input required type="text" name="hoTen" value="<?php if (isset($_POST['hoTen']))
          echo $_POST['hoTen']; ?>"></td>

        <td>Số con:</td>
        <td><input type="number" name="soCon" value="<?php if (isset($_POST['soCon']))
          echo $_POST['soCon']; ?>">
        </td>
      </tr>
      <tr>
        <td>Ngày sinh:</td>
        <td><input required  type="date" name="ngaySinh" value="<?php if (isset($_POST['ngaySinh']))
          echo $_POST['ngaySinh']; ?>"></td>

        <td>Ngày vào làm:</td>
        <td><input required  type="date" name="ngayVaoLam" value="<?php if (isset($_POST['ngayVaoLam']))
          echo $_POST['ngayVaoLam']; ?>"></td>
      </tr>
      <tr>
        <td>Giới tính:</td>
        <td> <input style="width: unset;" type="radio" name="gioiTinh" value="Nam" <?php if (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == 'Nam')
          echo 'checked="checked"'; ?> checked />
          Nam
          <input style="width: unset;" type="radio" name="gioiTinh" value="Nu" <?php if (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == 'Nu')
            echo 'checked="checked"'; ?> />Nữ
        </td>
        <td>Hệ số lương:</td>
        <td><input required  type="number" name="heSoLuong" value="<?php if (isset($_POST['heSoLuong']))
          echo $_POST['heSoLuong']; ?>"></td>
      </tr>
      <tr>
        <td>Loại nhân viên:</td>
        <td> <input checked style="width: unset;" type="radio" name="loaiNhanVien" value="vanphong" <?php if (isset($_POST['loaiNhanVien']) && $_POST['loaiNhanVien'] == 'vanphong')
          echo 'checked="checked"'; ?> /> Văn
          phòng</td>
        <td colspan="2"><input style="width: unset;" type="radio" name="loaiNhanVien" value="sanxuat" <?php if (isset($_POST['loaiNhanVien']) && $_POST['loaiNhanVien'] == 'sanxuat')
          echo 'checked="checked"'; ?> /> Sản
          xuất </td>
      </tr>
      <tr>
        <td style="border: none;"></td>
        <td>Số ngày vắng: <input  required style="width: 100px;" type="number" name="soNgayVang" value="<?php if (isset($_POST['soNgayVang']))
          echo $_POST['soNgayVang']; ?>"></td>
        <td colspan="2">Số sản phẩm: <input style="width: 100px;" type="number" name="soSanPham" value="<?php if (isset($_POST['soSanPham']))
          echo $_POST['soSanPham']; ?>"></td>
      </tr>
      <tr>
        <td colspan="4" style="text-align: center;"><button type="submit" name="tinhLuong">Tính lương</button>
        </td>
      </tr>
      <tr>
        <td>Tiền lương:</td>
        <td><input readonly style="width: 150px;" type="text" name="tienLuong" value="<?php if (isset($tienLuong))
          echo $tienLuong; ?>"> VNĐ</td>

        <td>Trợ cấp:</td>
        <td><input readonly style="width: 150px;" type="number" name="troCap" value="<?php if (isset($troCap))
          echo $troCap; ?>"> VNĐ</td>
      </tr>
      <tr>
        <td>Tiền thưởng:</td>
        <td><input readonly style="width: 150px;" type="text" name="tienThuong" value="<?php if (isset($tienThuong))
          echo $tienThuong; ?>"> VNĐ</td>

        <td>Tiền phạt:</td>
        <td><input readonly style="width: 150px;" type="text" name="tienPhat" value="<?php if (isset($tienPhat))
          echo $tienPhat; ?>"> VNĐ</td>
      </tr>
      <tr>
        <td colspan="4" style="text-align: center;">Thực lĩnh: <input readonly style="width: 200px;" type="text"
            name="thucLinh" value="<?php if (isset($thucLinh))
              echo $thucLinh; ?>"> VNĐ</td>
      </tr>
    </tbody>
  </table>
</form>
<br>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>