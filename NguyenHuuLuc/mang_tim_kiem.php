<?php
include '../templates/header.php';

function taoMang($n)
{
    $a = explode(', ', $n);
    return $a;
}

function xuatMang($a)
{
    return implode(", ", $a);
}

function timKiem($a, $n)
{
    for ($i = 0; $i < sizeof($a); $i++) {
        if ($a[$i] == $n) {
            return "Tìm thấy " . $n . " tại vị trí thứ " . ($i + 1) . " của mảng";
        }
    }
    return "Không tìm thấy";
}

if (isset($_POST['submit']) && isset($_POST['n']) && isset($_POST["a"])) {
    $n = $_POST["n"];
    $a = taoMang($_POST["a"]);
    $mang = xuatMang($a);
    $kq = timKiem($a, $n);
}
?>

<body>
    <form method="post" style="width:60%;">
        <table style="width:40%; border: none;">
            <thead style="background-color: #339a99;">
                <th colspan="2">
                    <h2>PHÁT SINH MẢNG VÀ TÍNH TOÁN</h2>
                </th>
            </thead>
            <tbody style="background-color: #d1ded4;">
                <tr>
                    <td>Nhập số phần tử:</td>
                    <td>
                        <input type="text" name="a" value="<?php if (isset($mang))
                            echo $mang; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nhập số cần tìm:</td>
                    <td>
                        <input type="text" name="n" value="<?php if (isset($n))
                            echo $n; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Tìm kiếm" name="submit"></td>
                </tr>
                <tr>
                    <td>Mảng: </td>
                    <td>
                        <input type="text" name="a" disabled value="<?php if (isset($mang))
                            echo $mang; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Kết quả tìm kiếm: </td>
                    <td>
                        <input type="text" name="kq" style="color:red;" disabled value="<?php if (isset($kq))
                            echo $kq; ?>">
                    </td>
                </tr>

            </tbody>
        </table>
    </form>
</body>

<?php include '../templates/footer.php' ?>