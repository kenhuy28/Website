<?php

function get_index($max_ma_sua, $Ma_hang_sua)
{
  $len_hang_sua = strlen($Ma_hang_sua);
  $index = "";
  for ($i = $len_hang_sua; $i < 6; $i++)
    $index .= $max_ma_sua[$i];
  $num_index = intval($index);
  $num_index++;
  $index = strval($num_index);
  $temp = array("0", "00", "000", "0000");
  $index = $Ma_hang_sua . $temp[6 - strlen($Ma_hang_sua) - strlen($index) - 1] . $index;
  return $index;
}

$Ten_sua = $_POST['ten-sua'];
$Ma_hang_sua = $_POST['hang-sua'];
$Ma_loai_sua = $_POST['loai-sua'];
$Trong_luong = $_POST['trong-luong'];
$Don_gia = $_POST['don-gia'];
$TP_Dinh_Duong = $_POST['thanh-phan-dinh-duong'];
$Loi_ich = $_POST['loi-ich'];

$errors = array();
$file_name = $_FILES['image']['name'];
$file_size = $_FILES['image']['size'];
$file_tmp = $_FILES['image']['tmp_name'];
$file_type = $_FILES['image']['type'];
$file_ext = @strtolower(end(explode('.', $_FILES['image']['name'])));
$expensions = array("jpeg", "jpg", "png");

$filepath = ($_SERVER['SCRIPT_NAME']);
$temp = explode('/', $filepath);
$savepath = "C:\\xampp\\htdocs";
for ($i = 1; $i < count($temp) - 1; $i++)
  $savepath .= "\\" . $temp[$i];
$savepath .= "\\img\\";

if (in_array($file_ext, $expensions) === false) {
  $errors[] = "Don't accept image files with this extension, please choose JPEG or PNG.";
}
if ($file_size > 2097152) {
  $errors[] = 'File size should be 2MB';
}
if (empty($errors) == true) {
  move_uploaded_file($file_tmp, $savepath . $file_name);
  echo "Upload File successfully!!!";
} else {
  print_r($errors);
}

$image_name = $savepath . $file_name;

$conn = mysqli_connect('localhost', 'root', '', 'qlbansua') or die('Could not connect to MySQL: ' . mysqli_connect_error());

// SELECT * FROM sua WHERE `Ma_hang_sua`="AB" and `Ma_loai_sua`="SB" ORDER BY Ma_sua DESC
$sql_lay_max_ma_sua = "SELECT * FROM sua WHERE Ma_hang_sua='$Ma_hang_sua'  ORDER BY Ma_sua DESC LIMIT 1";
$result_lay_max_ma_sua = mysqli_query($conn, $sql_lay_max_ma_sua);
$rows = mysqli_fetch_row($result_lay_max_ma_sua);
$max_ma_sua = $rows[0];
$Ma_sua = get_index($max_ma_sua, $Ma_hang_sua);

$sql_them_moi_sua = "INSERT INTO sua VALUES ('$Ma_sua', '$Ten_sua', '$Ma_hang_sua', '$Ma_loai_sua', '$Trong_luong', '$Don_gia', '$TP_Dinh_Duong', '$Loi_ich', '$image_name') ";
$result_hang_sua = mysqli_query($conn, $sql_them_moi_sua);
var_dump($result_hang_sua);

?>