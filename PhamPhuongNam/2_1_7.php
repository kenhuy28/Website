<?php
include '../templates/header.php';
?>
<style>
    table {
        background-color: wheat;
        width: 500px;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }

    th {
        background-color: white;
        font-family: "VNI-Times";
        color: blue;
        padding: 10px;
    }

    input[type="text"] {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }

    td {
        padding: 5px;
        border: 1px solid #ccc;
    }

    .note {
        text-align: center;
        background-color: yellow;
        padding: 10px;
        font-style: italic;
        font-size: 12px;
    }
</style>

<body>
    <?php
    function thayThe($socanthay, $sothay, &$mang)
    {
        for ($i = 0; $i < sizeof($mang); $i++) {
            if ($socanthay == $mang[$i]) {
                $mang[$i] = $sothay;
            }
        }
    }

    $mang = isset($_POST['mang']) ? trim($_POST['mang']) : "0";
    $socanthay = "";
    $sothay = "";
    $strmang = "";
    $mangmoi = "";
    $mangcu = "";

    if (isset($_POST['socanthay']) && isset($_POST['sothay']) && isset($_POST['strmang'])) {
        $socanthay = trim($_POST['socanthay']);
        $sothay = trim($_POST['sothay']);
        $strmang = trim($_POST['strmang']);
        $mang = explode(",", $strmang);
        $mangcu = implode(", ", $mang);
        thayThe($socanthay, $sothay, $mang);
        $mangmoi = implode(", ", $mang);
    }
    ?>

    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">THAY THẾ</h3>
            </th>
            <tr>
                <td>Nhập mảng:</td>
                <td>
                    <input type="text" name="strmang" value="<?= $strmang ?>">
                </td>
            </tr>
            <tr>
                <td>Giá trị cần thay thế:</td>
                <td>
                    <input type="text" name="socanthay" style="width: 30%;" value="<?= $socanthay ?>">
                </td>
            </tr>
            <tr>
                <td>Giá trị thay thế:</td>
                <td>
                    <input type="text" name="sothay" style="width: 30%;" value="<?= $sothay ?>">
                </td>
            </tr>
            <tr>
                <td> </td>
                <td>
                    <input type="submit" value="Thay thế" style="width: 30%;">
                </td>
            </tr>
            <tr>
                <td>Mảng cũ:</td>
                <td>
                    <input type="text" value="<?= $mangcu ?>" disabled>
                </td>
            </tr>
            <tr>
                <td>Mảng sau khi thay thế:</td>
                <td>
                    <input type="text" value="<?= $mangmoi ?>" disabled>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; background-color: yellow;">
                    <span style="color:red;">(*)</span> Các số được nhập cách nhau bởi dấu ","
                </td>
            </tr>
        </table>
    </form>
</body>
 <?php include '../templates/footer.php' ?>