<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Thêm sữa mới</title>
  <style>
    body {
      font-family: sans-serif;
      background-color: #f5f5f5;
    }

    form {
      width: 700px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      background-color: #fff;
    }

    label {
      font-size: 16px;
      font-weight: 600;
      width: 30%;
      display: inline-block;
    }

    div {
      margin: 5px;
      height: 35px;
    }

    input {
      width: 55%;
      display: inline-block;
      line-height: 2;
    }

    h1 {
      text-align: center;
      background-color: #fe6c6c;
      margin-top: -15px;
      padding-top: 5px;
      height: 40px;
    }
  </style>
</head>

<body>
  <?php
  $conn = mysqli_connect('localhost', 'root', '', 'qlbansua') or die('Could not connect to MySQL: ' . mysqli_connect_error());
  $sql_hang_sua = "select * from hang_sua ";
  $result_hang_sua = mysqli_query($conn, $sql_hang_sua);
  $sql_loai_sua = "select * from loai_sua ";
  $result_loai_sua = mysqli_query($conn, $sql_loai_sua);
  ?>
  <form action="xulythemsua.php" method="post" enctype="multipart/form-data" style="background-color: #fddedc;">
    <h1>Thêm sữa</h1>
    <div>
      <label for="ten-sua">Tên sữa</label>
      <input type="text" name="ten-sua" id="ten-sua" placeholder="Nhập tên sữa">
    </div>
    <div>
      <label for="hang-sua">Hãng sữa</label>
      <select name="hang-sua">
        <?php
        while ($rows = mysqli_fetch_row($result_hang_sua)) {
          echo "<option value='" . $rows[0] . "'>" . $rows[1] . "</option>";
        } //while ?>
      </select>
    </div>
    <div>
      <label for="loai-sua">Loại sữa</label>
      <select name="loai-sua">
        <?php
        while ($rows = mysqli_fetch_row($result_loai_sua)) {
          echo "<option value='" . $rows[0] . "'>" . $rows[1] . "</option>";
        } //while ?>
      </select>
    </div>
    <div>
      <label for="trong-luong">Trọng lượng</label>
      <input type="number" name="trong-luong" id="trong-luong" placeholder="Nhập trọng lượng">
    </div>
    <div>
      <label for="don-gia">Đơn giá</label>
      <input type="number" name="don-gia" id="don-gia" placeholder="Nhập đơn giá">
    </div>
    <div>
      <label for="thanh-phan-dinh-duong">Thành phần dinh dưỡng</label>
      <input type="text" name="thanh-phan-dinh-duong" id="thanh-phan-dinh-duong"
        placeholder="Nhập thành phần dinh dưỡng">
    </div>
    <div>
      <label for="loi-ich">Lợi ích</label>
      <input type="text" name="loi-ich" id="loi-ich" placeholder="Nhập lợi ích">
    </div>
    <div>
      <label for="image">Hình ảnh</label>
      <input type="file" name="image" id="image">
    </div>
    <button type="submit">Thêm mới</button>
  </form>
</body>

</html>