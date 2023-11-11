<?php include '../templates/header.php'; ?>

<?php
function taoMang($m, $n)
{
    $matrix = [];
    for ($i = 0; $i < $m; $i++) {
        $matrix[$i] = [];
        for ($j = 0; $j < $n; $j++) {
            $matrix[$i][$j] = rand(-1000, 1000);
        }
    }
    return $matrix;
}

function hienThiDongChanCotLe($matrix, $m, $n)
{
    $temp = "";
    for ($i = 0; $i < $m; $i += 2) {
        for ($j = 1; $j < $n; $j += 2) {
            $temp .= $matrix[$i][$j] . " ";
        }
    }
    return $temp;
}

function inMang($matrix, $m, )
{
    $temp = "";
    for ($i = 0; $i < $m; $i++) {
        $temp .= implode(", ", $matrix[$i]) . "\n";
    }
    return $temp;
}

function tongPhanTuLaBoiSoCua10($matrix, $m, $n)
{
    $sum = 0;
    for ($i = 0; $i < $m; $i++) {
        for ($j = 0; $j < $n; $j++) {
            if ($matrix[$i][$j] % 10 == 0) {
                $sum += $matrix[$i][$j];
            }
        }
    }
    return $sum;
}

if (isset($_POST["submit"]) && isset($_POST["m"]) && isset($_POST["n"])) {
    $m = $_POST["m"];
    $n = $_POST["n"];
    $matrix = taoMang($m, $n);
    $kq = inMang($matrix, $m);
    $kq .= "\nCác phần tử thuộc dòng chẵn cột lẻ: " . hienThiDongChanCotLe($matrix, $m, $n);
    $kq .= "\nTổng các phần tử là bội số của 10: " . tongPhanTuLaBoiSoCua10($matrix, $m, $n);
}
?>

<form method="post">
    <table>
        <thead>
            <th colspan="2" align="center">
                <h2>Tạo và hiển thị ma trận số nguyên</h2>
            </th>
        </thead>
        <tbody>
            <tr>
                <td>Số dòng (m): </td>
                <td><input type="number" name="m" min="2" max="5" style="width:50px"></td>
            </tr>
            <tr>
                <td>Số cột (n): </td>
                <td><input type="number" name="n" min="2" max="5" style="width:50px"></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" value="Tạo ma trận" name="submit"></td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <textarea cols="50" rows="12"><?php if (isset($kq))
                        echo $kq; ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<button type="button" onclick="window.history.go(-1);">Quay lại</button>
<?php include '../templates/footer.php' ?>