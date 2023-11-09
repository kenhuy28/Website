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
            text-align: center;
            width: 33%;
        }
    </style>
</head>

<body>
    <?php
    function tongDaySo($ds)
    {
        $dsSo = explode(',', $ds);
        $tong = (int) 0;
        for ($i = 0; $i < sizeof($dsSo); $i++)
            $tong += (int) $dsSo[$i];

        return $tong;
    }

    if (isset($_POST['dayso']))
        $dayso = trim($_POST['dayso']);
    else
        $dayso = "0";

    $ketqua = tongDaySo($dayso);
    ?>
    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">NHẬP VÀ TÍNH TRÊN DÃY SỐ</h3>
            </th>

            <tr>
                <td>Nhập dãy số:</td>
                <td>
                    <input type="text" name="dayso" value="<?php if (isset($_POST['dayso']))
                        echo $dayso; ?>">
                </td>
                <td style="color:red; text-align: left;">(*)</td>

            </tr>
            <tr>
                <td> </td>
                <td>
                    <button type="submit">Tổng dãy số</button>
                </td>
                <td> </td>
            </tr>
            <tr>
                <td>Tổng dãy số:</td>
                <td><input type="text" value="<?php
                echo $ketqua; ?>" disabled></td>
                <td></td>

            </tr>
            <tr>
                <td colspan='3'>
                    <span style="color:red;">(*)</span> Các số được nhập cách nhau bởi dấu ","
                </td>
            </tr>

        </table>
    </form>


</body>

</html>