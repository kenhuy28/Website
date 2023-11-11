<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sắp xếp</title>
    <style type="text/css">
        table {
            background-color: wheat;
            width: 500px;
        }

        th {
            background-color: white;
            color: blue;
            font-family: 'Courier New', Courier, monospace;
        }

        input {
            margin-left: -15%;
            width: 100%;
        }

        td {
            padding-left: 5px;
        }
    </style>
</head>

<body>
    <?php
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
            for ($j = 0; $j < $soPhanTu; $j++)
                if ($mang[$i] < $mang[$j])
                    swap($mang[$i], $mang[$j]);
        return $mang;
    }

    if (isset($_POST['strmang'])) {
        $strmang = trim($_POST['strmang']);
        $mang = explode(",", $strmang);
        $mangtangdan = sapXepTangDan($mang);
        $strmangtangdan = implode(", ", $mangtangdan);
        $manggiamdan = array_reverse($mangtangdan);
        $strmanggiamdan = implode(", ", $manggiamdan);
    } else
        $strmang = "0";


    ?>
    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">SẮP XẾP MẢNG</h3>
            </th>
            <tr>
                <td>Nhập mảng:</td>
                <td>
                    <input type="text" name="strmang" value="<?php if (isset($_POST['strmang']))
                        echo $strmang; ?>">
            </tr>
            <tr>
                <td> </td>
                <td>
                    <input type="submit" value="Sắp xếp" style="width: 30%;">
                </td>
            </tr>
            <tr>
                <td><span style="color: red; font-weight: bold;">Sau khi sắp xếp:</span></td>
                <td></td>
            </tr>
            <tr>
                <td>Tăng dần:</td>
                <td><input type="text" value="<?php
                echo $strmangtangdan; ?>" disabled></td>
            </tr>
            <tr>
                <td>Giảm dần:</td>
                <td><input type="text" value="<?php
                echo $strmanggiamdan; ?>" disabled></td>
            </tr>
            <tr>
                <td colspan='2' style="text-align: center; background-color: yellow;">
                    <span style="color:red;">(*)</span> Các số được nhập cách nhau bởi dấu ","
                </td>
            </tr>
        </table>
    </form>
</body>

</html>