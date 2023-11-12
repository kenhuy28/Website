<?php include("../templates/header.php") ?>
<?php
class PhanSo
{
  private $tuSo;
  private $mauSo;

  public function __construct($tuSo, $mauSo)
  {
    $this->tuSo = $tuSo;
    $this->mauSo = $mauSo;
  }

  public function getTuSo()
  {
    return $this->tuSo;
  }

  public function getMauSo()
  {
    return $this->mauSo;
  }

  public function rutGon()
  {
    $ucln = $this->timUCLN($this->tuSo, $this->mauSo);
    $this->tuSo /= $ucln;
    $this->mauSo /= $ucln;
  }

  private function timUCLN($a, $b)
  {
    while ($b != 0) {
      $a = $a % $b;
      $t = $b;
      $b = $a;
      $a = $t;
    }
    return $a;
  }
}

class PhepTinh
{
  public static function cong(PhanSo $ps1, PhanSo $ps2)
  {
    $tuSo = $ps1->getTuSo() * $ps2->getMauSo() + $ps2->getTuSo() * $ps1->getMauSo();
    $mauSo = $ps1->getMauSo() * $ps2->getMauSo();
    return new PhanSo($tuSo, $mauSo);
  }

  public static function tru(PhanSo $ps1, PhanSo $ps2)
  {
    $tuSo = $ps1->getTuSo() * $ps2->getMauSo() - $ps2->getTuSo() * $ps1->getMauSo();
    $mauSo = $ps1->getMauSo() * $ps2->getMauSo();
    return new PhanSo($tuSo, $mauSo);
  }

  public static function nhan(PhanSo $ps1, PhanSo $ps2)
  {
    $tuSo = $ps1->getTuSo() * $ps2->getTuSo();
    $mauSo = $ps1->getMauSo() * $ps2->getMauSo();
    return new PhanSo($tuSo, $mauSo);
  }

  public static function chia(PhanSo $ps1, PhanSo $ps2)
  {
    $tuSo = $ps1->getTuSo() * $ps2->getMauSo();
    $mauSo = $ps1->getMauSo() * $ps2->getTuSo();
    return new PhanSo($tuSo, $mauSo);
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tuSo1 = $_POST['tuSo1'];
  $mauSo1 = $_POST['mauSo1'];
  $tuSo2 = $_POST['tuSo2'];
  $mauSo2 = $_POST['mauSo2'];

  $phepTinh = $_POST['phepTinh'];

  $ps1 = new PhanSo($tuSo1, $mauSo1);
  $ps2 = new PhanSo($tuSo2, $mauSo2);

  $ps1->rutGon();
  $ps2->rutGon();

  switch ($phepTinh) {
    case 'Cong':
      $ketQua = PhepTinh::cong($ps1, $ps2);
      break;
    case 'Tru':
      $ketQua = PhepTinh::tru($ps1, $ps2);
      break;
    case 'Nhan':
      $ketQua = PhepTinh::nhan($ps1, $ps2);
      break;
    case 'Chia':
      $ketQua = PhepTinh::chia($ps1, $ps2);
      break;
  }
  $ketQua->rutGon();
}
?>

<style>
  input {
    width: 50px;
    border-radius: 4px;
  }
</style>

<h1>Phép Tính Phân Số</h1>

<form method="post" action="">
  Nhập phân số thứ nhất:
  <label for="tuSo1">Tử số 1:</label>
  <input type="number" name="tuSo1" required value="<?php if (isset($_POST['tuSo1']))
    echo $_POST['tuSo1']; ?>">

  <label for="mauSo1">&nbsp;&nbsp;Mẫu số 1:</label>
  <input type="number" name="mauSo1" required value="<?php if (isset($_POST['mauSo1']))
    echo $_POST['mauSo1']; ?>"><br>
  <br>
  Nhập phân số thứ hai:&nbsp;&nbsp;&nbsp;
  <label for="tuSo2">Tử số 2:</label>
  <input type="number" name="tuSo2" required value="<?php if (isset($_POST['tuSo2']))
    echo $_POST['tuSo2']; ?>">

  <label for="mauSo2">&nbsp;&nbsp;Mẫu số 2:</label>
  <input type="number" name="mauSo2" required value="<?php if (isset($_POST['mauSo2']))
    echo $_POST['mauSo2']; ?>"><br>
  <br>
  <fieldset>
    <legend>Chọn phép tính:</legend>
    <input type="radio" name="phepTinh" value="Cong" checked <?php if (isset($_POST['phepTinh']) && $_POST['phepTinh'] == 'Cong')
      echo 'checked="checked"'; ?>> Cộng
    <input type="radio" name="phepTinh" value="Tru" <?php if (isset($_POST['phepTinh']) && $_POST['phepTinh'] == 'Tru')
      echo 'checked="checked"'; ?>> Trừ
    <input type="radio" name="phepTinh" value="Nhan" <?php if (isset($_POST['phepTinh']) && $_POST['phepTinh'] == 'Nhan')
      echo 'checked="checked"'; ?>> Nhân
    <input type="radio" name="phepTinh" value="Chia" <?php if (isset($_POST['phepTinh']) && $_POST['phepTinh'] == 'Chia')
      echo 'checked="checked"'; ?>> Chia<br>
  </fieldset>
  <br>
  <button type="submit">Kết quả</button>
</form>

<?php
if (isset($ketQua)) {
  $arrr = array("Cong" => "+", "Tru" => "-", "Nhan" => "*", "Chia" => "/" );
  echo '<h2>Kết quả:</h2>';
  echo "{$ps1->getTuSo()}/{$ps1->getMauSo()} {$arrr[$phepTinh]} {$ps2->getTuSo()}/{$ps2->getMauSo()} = {$ketQua->getTuSo()}/{$ketQua->getMauSo()}";
}
?>

<br>
<br>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>