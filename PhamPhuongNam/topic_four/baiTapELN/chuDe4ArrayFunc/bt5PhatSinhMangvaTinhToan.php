<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Mang tim kiem va thay the</title>
    <style type="text/css">
        table {
            background-color: wheat;
        }

        th {

            background-color: white;

            font-style: vni-times;

            color: blue;
        }

        td {
            text-align: left;
            width: 33%;
        }
    </style>
</head>

<body>
    <?php

    function phatSinh($n)
    {
        $a = array();
        for ($i = 0; $i < $n; $i++)
            $a[$i] = rand(0, 20);
        return $a;
    }
    function timMinMAX(&$minmang, &$maxmang, $mang)
    {
        for ($i = 0; $i < sizeof($mang); $i++)
            if ($maxmang < $mang[$i])
                $maxmang = $mang[$i];
        $minmang = $maxmang;
        for ($i = 0; $i < sizeof($mang); $i++)
            if ($minmang > $mang[$i])
                $minmang = $mang[$i];
    }
    function tongMang($arr)
    {
        $tong = (int) 0;
        foreach ($arr as $key => $value)
            $tong += $value;
        return $tong;
    }
    if (isset($_POST['n'])) {
        $n = trim($_POST['n']);
        $mang = phatSinh($n);
        $phantumang = implode(", ", $mang);
        $minmang = 0;
        $maxmang = 0;
        timMinMAX($minmang, $maxmang, $mang);
        $tong = tongMang($mang);
    } else
        $n = 0;
    ?>
    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">Phát sinh mảng và tính toán</h3>
            </th>

            <tr>
                <td>Nhập số phần tử:</td>
                <td colspan="2">
                    <input type="number" name="n" value="<?php if (isset($_POST['n']))
                        echo $n; ?>">
                </td>
            </tr>
            <tr>
                <td> </td>
                <td colspan="2">
                    <button type="submit">Phát sinh và tính toán</button>
                </td>
            </tr>
            <tr>
                <td>Mảng:</td>
                <td colspan="2"><input type="text" value="<?php
                echo $phantumang; ?>" disabled></td>

            </tr>
            <tr>
                <td>Giá trị MAX:</td>
                <td colspan="2"><input type="text" value="<?php
                echo $maxmang; ?>" disabled></td>

            </tr>
            <tr>
                <td>Giá trị MIN:</td>
                <td colspan="2"><input type="text" value="<?php
                echo $minmang; ?>" disabled></td>

            </tr>
            <tr>
                <td>Tổng mảng:</td>
                <td colspan="2"><input type="text" value="<?php
                echo $tong; ?>" disabled></td>

            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">(<span style="color: red;">Ghi chú: </span>Các phần tử trong
                    mảng sẽ có giá trọ từ 0 đến 20)</td>

            </tr>


        </table>
    </form>


</body>

</html>