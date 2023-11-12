<?php
include '../templates/header.php';
?>

    <style type="text/css">
    table {
        background-color: #f5f5f5;
        width: 500px;
        border-collapse: collapse;
    }

    th {
        background-color: #e0e0e0;
        font-family: "VNI-Times";
        color: #333;
        padding: 8px;
        text-align: left;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 30%;
        padding: 8px 12px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    input[disabled] {
        background-color: #f5f5f5;
        color: #999;
    }

    td {
        padding: 8px;
    }

    .note {
        text-align: center;
        background-color: #ffeb3b;
        color: #333;
        padding: 8px;
        font-size: 12px;
        font-style: italic;
    }
</style>

<?php
function timKiem($so, $mang)
{
    $index = -1;
    for ($i = 0; $i < sizeof($mang); $i++) {
        if ($so == $mang[$i]) {
            $index = $i;
            break;
        }
    }
    if ($index == -1) {
        return "Không tìm thấy $so trong mảng";
    } else {
        return "Đã tìm thấy $so tại vị trí thứ " . ($index + 1) . " của mảng";
    }
}

$strmang = "";
$socantim = "";
$dsphantu = "";
$ketquatimkiem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['strmang'])) {
        $strmang = trim($_POST['strmang']);
        $mang = explode(",", $strmang);
        $dsphantu = implode(", ", $mang);
    }

    if (isset($_POST['socantim'])) {
        $socantim = trim($_POST['socantim']);
        $ketquatimkiem = timKiem($socantim, $mang);
    }
}
?>

<body>
    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">TÌM KIẾM</h3>
            </th>
            <tr>
                <td>Nhập mảng:</td>
                <td>
                    <input type="text" name="strmang" value="<?php echo $strmang; ?>">
                </td>
            </tr>
            <tr>
                <td>Nhập số cần tìm:</td>
                <td>
                    <input type="text" name="socantim" style="width: 30%;" value="<?php echo $socantim; ?>">
                </td>
            </tr>
            <tr>
                <td> </td>
                <td>
                    <input type="submit" value="Tìm kiếm" style="width: 30%;">
                </td>
            </tr>
            <tr>
                <td>Mảng:</td>
                <td>
                    <input type="text" value="<?php echo $dsphantu; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td>Kết quả tìm kiếm:</td>
                <td>
                    <input type="text" value="<?php echo $ketquatimkiem; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td colspan='2' style="text-align: center; background-color: yellow;">
                    <span style="color:red;">(*)</span> Các số được nhập cách nhau bởi dấu ","
                </td>
            </tr>
        </table>
    </form>
</body>

<?php include '../templates/footer.php' ?>