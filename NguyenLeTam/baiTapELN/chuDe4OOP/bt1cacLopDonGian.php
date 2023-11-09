<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    td {
      min-width: 100px;
    }
  </style>
</head>

<body>
  <?php  include "oopBT1.php" ?> 
  <?php 

    ?> 
  <form action="" method="post">
    <table>
      <thead>
        <tr>
          <td colspan="2" align="center">
            Nhập thông tin
          </td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            Đối tượng:
          </td>
          <td>
            <input type="radio" name="doiTuong" value="SinhVien" <?php if (isset($_POST['doiTuong']) && $_POST['doiTuong'] == 'SinhVien')
              echo 'checked="checked"'; ?> checked /> Sinh
            Viên
            <input type="radio" name="doiTuong" value="GiangVien" <?php if (isset($_POST['doiTuong']) && $_POST['doiTuong'] == 'GiangVien')
              echo 'checked="checked"'; ?> /> Giảng Viên
          </td>
        </tr>
        <tr>
          <td>
            Họ tên:
          </td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td>
            Địa chỉ:
          </td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td>
            Giới tính:
          </td>
          <td>
            <input style="width: unset;" type="radio" name="gioiTinh" value="Nam" <?php if (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == 'Nam')
              echo 'checked="checked"'; ?> checked />
            Nam
            <input style="width: unset;" type="radio" name="gioiTinh" value="Nu" <?php if (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == 'Nu')
              echo 'checked="checked"'; ?> />Nữ
          </td>
        </tr>
        <tr id="lopHocRow">
          <td>
            Lớp học:
          </td>
          <td><input type="text"></td>
        </tr>
        <tr id="nganhHocRow">
          <td>
            Ngành học:
          </td>
          <td><input type="text"></td>
        </tr>
        <tr id="trinhDoRow" hidden>
          <td>
            Trình độ:
          </td>
          <td><input type="text"></td>
        </tr>
      </tbody>
    </table>
  </form>


  <script>
    var sinhvienRadio = document.querySelector('input[value="SinhVien"]');
    var giangvienRadio = document.querySelector('input[value="GiangVien"]');
    var lopHocRow = document.getElementById('lopHocRow');
    var nganhHocRow = document.getElementById('nganhHocRow');
    var trinhDoRow = document.getElementById('trinhDoRow');

    sinhvienRadio.addEventListener('change', function () {
      if (sinhvienRadio.checked) {
        lopHocRow.style.display = 'table-row';
        nganhHocRow.style.display = 'table-row';
        trinhDoRow.style.display = 'none';
      }
    });

    giangvienRadio.addEventListener('change', function () {
      if (giangvienRadio.checked) {
        lopHocRow.style.display = 'none';
        nganhHocRow.style.display = 'none';
        trinhDoRow.style.display = 'table-row';
      }
    });


  </script>
</body>

</html>