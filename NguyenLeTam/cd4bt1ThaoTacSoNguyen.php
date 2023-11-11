<?php include("../templates/header.php") ?>

<head>
    <style type="text/css">
        table {
            color: #ffff00;
            background-color: gray;
        }

        table th {
            background-color: blue;
            font-style: vni-times;
            color: yellow;
        }
    </style>
</head>

<?php
function hienThiMang($mang)
{
    echo "<br> ";
    echo "Các phần tử của mảng: ";
    echo $mang[0];
    for ($i = 1; $i < sizeof($mang); $i++) {
        echo ", " . $mang[$i];
    }
    echo "<br> ";
}

function demSoChan($mang)
{
    $dem = 0;
    for ($i = 0; $i < sizeof($mang); $i++)
        if ($mang[$i] % 2 == 0)
            $dem++;

    return $dem;
}

function demSoBeHon100($mang)
{
    $dem = 0;
    for ($i = 0; $i < sizeof($mang); $i++)
        if ($mang[$i] < 100)
            $dem++;
    return $dem;
}
function tongSoBeHon0($mang)
{
    $tong = 0;
    for ($i = 0; $i < sizeof($mang); $i++)
        if ($mang[$i] < 0)
            $tong += $mang[$i];
    return $tong;
}
function demSoKeCuoiLa0($mang)
{
    $dem = array();
    for ($i = 0; $i < sizeof($mang); $i++)
        if (abs($mang[$i]) > 99 && abs($mang[$i]) % 100 < 10)
            $dem[] = $mang[$i];
    $strdemSoKeCuoiLa0 = implode(", ", $dem);
    return $strdemSoKeCuoiLa0;
}
function swap(&$so1, &$so2)
{
    $so1 += $so2;
    $so2 = $so1 - $so2;
    $so1 = $so1 - $so2;
}
function sapXepTangDan($mang)
{
    $soPhanTu = sizeof($mang);
    for ($i = 0; $i < $soPhanTu; $i++)
        for ($j = $i + 1; $j < $soPhanTu; $j++)
            if ($mang[$i] > $mang[$j])
                swap($mang[$i], $mang[$j]);
    $str = implode(", ", $mang);
    return $str;
}
function taoMang($sopt)
{
    $temp = array();
    for ($i = 0; $i < $sopt; $i++)
        $temp[$i] = rand(-1000, 1000);
    return $temp;
}

if (isset($_POST['n']))
    $n = trim($_POST['n']);
else
    $n = 0;
$ketqua = "";
if (isset($_POST['tinh']) && $n > 0) {
    $a = taoMang($n);
    $str = implode("  ", $a);
    $ketqua = "a. Mảng được tạo ra: " . $str;
    $ketqua .= "\nb. Số phần tử chẵn: " . demSoChan($a);
    $ketqua .= "\nc. Số phần tử có giá trị <100: " . demSoBeHon100($a);
    $ketqua .= "\nd. Tổng các phần tử âm: " . tongSoBeHon0($a);
    $ketqua .= "\ne. Các phẩn tử có 0 là chữ số kề cuối: " . demSoKeCuoiLa0($a);
    $ketqua .= "\nf. Sắp xếp theo thứ tự tăng dần: " . sapXepTangDan($a);
} else {
    $ketqua = "Đầu vào sai!!!";
}

?>
<form action="" method="post">
    <table border="0" cellpadding="0">
        <th colspan="3">
            <h2 style="margin-bottom: 5px; margin-top: 5px; ">THAO TÁC TRÊN MẢNG</h2>
        </th>
        <tr style="height: 30px;">
            <td>&nbsp; Nhập số lượng phần tử:</td>
            <td><input type="number" name="n" style="min-width: 100px;max-width: 150px;" value="<?php if (isset($_POST['n']))
                echo $n; ?>" /></td>

            <td align="center"><input type="submit" name="tinh" size="20" value="  Xử lý  " /></td>

        </tr>
        <tr>
            <td colspan='3'><textarea name="ketqua" id="ketqua" cols="60" rows="10"
                    style="font-family: 'Times New Roman', Times, serif; font-size: 15px;"><?php echo $ketqua; ?> </textarea>
            </td>
        </tr>
    </table>
</form>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>