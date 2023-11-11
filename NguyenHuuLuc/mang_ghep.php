<?php
include '../templates/header.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
        table {
            background-color: ffd6f1;
            width: 500px;
        }

        th {
            background-color: a20a6f;
            font-style: vni-times;
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

    function merge_array($manga, $mangb, $na, $nb)
    {
        $mangc = $manga;
        for ($i = $na; $i < $nb + $na; $i++) {
            $mangc[$i] = $mangb[$i - $na];
        }
        return $mangc;
    }

    function sxTangDan($mangc)
    {
        $c = $mangc;
        for ($i = 0; $i < sizeof($mangc); $i++) {
            for ($j = $i; $j < sizeof($mangc); $j++) {
                if ($c[$i] > $c[$j]) {
                    $temp = $c[$i];
                    $c[$i] = $c[$j];
                    $c[$j] = $temp;
                }
            }
        }
        return $c;
    }

    function sxGiamDan($mangc)
    {
        $c = $mangc;
        for ($i = 0; $i < sizeof($mangc); $i++) {
            for ($j = $i; $j < sizeof($mangc); $j++) {
                if ($c[$i] < $c[$j]) {
                    $temp = $c[$i];
                    $c[$i] = $c[$j];
                    $c[$j] = $temp;
                }
            }
        }
        return $c;
    }

    if (isset($_POST['submit']) && isset($_POST["a"]) && isset($_POST["b"])) {
        $a = $_POST["a"];
        $b = $_POST["b"];
        $manga = explode(",", $a);
        $mangb = explode(",", $b);
        $na = sizeof($manga);
        $nb = sizeof($mangb);
        $mangc = merge_array($manga, $mangb, $na, $nb);
        $c = implode(",", $mangc);
        $td = implode(", ", sxTangDan($mangc));
        $gd = implode(", ", sxGiamDan($mangc));
    }
    ?>
    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">ĐẾM PHẦN TỬ, GHÉP MẢNG VÀ SẮP XẾP</h3>
            </th>
            <tr>
                <td>Mảng A:</td>
                <td>
                    <input type="text" name="a" value="<?php if (isset($_POST['a']))
                        echo $a; ?>">
            </tr>
            <tr>
                <td>Mảng B:</td>
                <td>
                    <input type="text" name="b" value="<?php if (isset($_POST['b']))
                        echo $b; ?>">
            </tr>
            <tr>
                <td> </td>
                <td>
                    <input type="submit" name="submit" value="Thay thế" style="width: 30%;">
                </td>
            </tr>
            <tr>
                <td>Số phần tử mảng A:</td>
                <td><input type="text" style="width:80px;" value="<?php if (isset($na))
                    echo $na; ?>" disabled></td>
            </tr>
            <tr>
                <td>Số phần tử mảng B:</td>
                <td><input type="text" style="width:80px;" value="<?php if (isset($nb))
                    echo $nb; ?>" disabled></td>
            </tr>
            <tr>
                <td>Mảng C:</td>
                <td><input type="text" value="<?php if (isset($c))
                    echo $c; ?>" disabled></td>
            </tr>
            <tr>
                <td>Mảng C tăng dần:</td>
                <td><input type="text" value="<?php if (isset($td))
                    echo $td; ?>" disabled></td>
            </tr>
            <tr>
                <td>Mảng C giảm dần:</td>
                <td><input type="text" value="<?php if (isset($gd))
                    echo $gd; ?>" disabled></td>
            </tr>
            <tr>
                <td colspan='2' style="text-align: center;">
                    <span style="color:red;">(*)</span> Các số được nhập cách nhau bởi dấu ","
                </td>
            </tr>
        </table>
    </form>
    <button type="button" onclick="window.history.go(-1);">Quay lại</button>
</body>

</html>

<?php include '../templates/footer.php' ?>