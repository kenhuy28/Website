<?php
include '../templates/header.php';

function taoMang($n)
{
    $a = array();
    for ($i = 0; $i < $n; $i++) {
        $a[$i] = rand(0, 20);
    }
    return $a;
}

function xuatMang($a)
{
    return implode(", ", $a);
}

function tinhTong($a)
{
    $sum = 0;
    for ($i = 0; $i < sizeof($a); $i++) {
        $sum += $a[$i];
    }
    return $sum;
}

function timMax($a)
{
    $max = $a[0];
    for ($i = 0; $i < sizeof($a); $i++) {
        if ($max < $a[$i]) {
            $max = $a[$i];
        }
    }
    return $max;
}

function timMin($a)
{
    $min = $a[0];
    for ($i = 0; $i < sizeof($a); $i++) {
        if ($min > $a[$i]) {
            $min = $a[$i];
        }
    }
    return $min;
}

if (isset($_POST['submit']) && isset($_POST['n'])) {
    $n = $_POST["n"];
    $a = taoMang($n);
    $mang = xuatMang($a);
    $tong = tinhTong($a);
    $max = timMax($a);
    $min = timMin($a);
}
?>

<body>
    <form method="post" style="width:60%;">
        <table style="width:40%; border: none;">
            <thead style="background-color: #a70f75;">
                <th colspan="2">
                    <h2>PHÁT SINH MẢNG VÀ TÍNH TOÁN</h2>
                </th>
            </thead>
            <tbody style="background-color: #ffdbf6;">
                <tr>
                    <td>Nhập số phần tử:</td>
                    <td>
                        <input type="text" name="n" value="<?php if (isset($n))
                            echo $n; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Phát sinh và tính toán" name="submit"></td>
                </tr>
                <tr>
                    <td>Mảng: </td>
                    <td>
                        <input type="text" name="mang" disabled value="<?php if (isset($mang))
                            echo $mang; ?>">
                    </td>
                </tr>
                <tr>
                    <td>GTLN (MAX) trong mảng: </td>
                    <td>
                        <input type="text" name="max" disabled value="<?php if (isset($max))
                            echo $max; ?>">
                    </td>
                </tr>
                <tr>
                    <td>GTNN (MIN) trong mảng: </td>
                    <td>
                        <input type="text" name="min" disabled value="<?php if (isset($min))
                            echo $min; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Tổng mảng: </td>
                    <td>
                        <input type="text" name="tong" disabled value="<?php if (isset($tong))
                            echo $tong; ?>">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>

<?php include '../templates/footer.php' ?>