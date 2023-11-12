<?php include("../templates/header.php") ?>
<?php
function taoMaTranNgauNhien($m, $n)
{
  $maTran = array();
  for ($i = 0; $i < $m; $i++)
    for ($j = 0; $j < $n; $j++)
      $maTran[$i][$j] = rand(-1000, 1000);
  return $maTran;
}
function hienThiMaTran($maTran)
{
  $output = "";
  foreach ($maTran as $hang)
    $output .= implode(' ', $hang) . "\n";
  return $output;
}

function hienThiPhanTuDongChanCotLe($maTran)
{
  $output = "";
  $m = count($maTran);
  $n = count($maTran[0]);
  for ($i = 0; $i < $m; $i += 2)
    for ($j = 1; $j < $n; $j += 2)
      $output .= $maTran[$i][$j] . " ";
  return $output;
}

function tinhTongBoiSo10($maTran)
{
  $tong = 0;
  foreach ($maTran as $hang) foreach ($hang as $phanTu)
      if ($phanTu % 10 == 0)
        $tong += $phanTu;
  return $tong;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $m = isset($_POST['m']) ? intval($_POST['m']) : 2;
  $n = isset($_POST['n']) ? intval($_POST['n']) : 2;
  if ($m < 2 || $m > 5 || $n < 2 || $n > 5) {
    echo "Vui lòng nhập m và n sao cho 2 <= m, n <= 5";
    exit;
  }
  $maTran = taoMaTranNgauNhien($m, $n);
}
?>
<h1>Tạo và Hiển Thị Ma Trận</h1>
<form method="post" action="">
  <label for="m">Số dòng (2 <= m <=5):</label>
      <input type="number" name="m" min="2" max="5" value="<?php echo isset($m) ? $m : 2 ?>" required>
      <label for="n">Số cột (2 <= n <=5):</label>
          <input type="number" name="n" min="2" max="5" value="<?php echo isset($n) ? $n : 2 ?>" required>
          <button type="submit" name="submit">Tạo và Hiển Thị Ma Trận</button>
</form>
<?php
if (isset($maTran)) {
  echo '<h2>Ma Trận:</h2>';
  echo '<textarea rows="10" cols="30">' . hienThiMaTran($maTran) . '</textarea>';
  echo '<h2>Phần Tử Dòng Chẵn Cột Lẻ:</h2>';
  echo '<p>' . hienThiPhanTuDongChanCotLe($maTran) . '</p>';
  echo '<h2>Tổng Các Phần Tử là Bội Số của 10:</h2>';
  echo '<p>' . tinhTongBoiSo10($maTran) . '</p>';
}
?>
<br>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>