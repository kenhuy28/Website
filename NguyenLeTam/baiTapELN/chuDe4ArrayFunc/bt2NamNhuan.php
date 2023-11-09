<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Mang tim kiem va thay the</title>
    <style type="text/css">
        table {

            color: #ffff00;

            background-color: gray;

        }

        th {

            background-color: white;

            font-style: vni-times;

            color: blue;
        }
        
    </style>
</head>

<body>
    <?php
    function kiemTraNhuan($x)
    {
        if ($x % 400 == 0)
            return true;
        if ($x % 4 == 0 && $x % 100 != 0)
            return true;
        return false;
    }
    function lonHon2000($n)
    {
        $lon2000 = array();
        $k = 0;
        for ($i = 2000; $i < $n; $i += 4)
            if (kiemTraNhuan($i))
                $lon2000[$k++] = $i;
        return $lon2000;
    }
    function beHon2000($n)
    {
        $be2000 = array();
        $k = 0;
        for ($i = 2000; $i > $n; $i -= 4)
            if (kiemTraNhuan($i))
                $be2000[$k++] = $i;
        return $be2000;
    }

    if (isset($_POST['lon2000']))
        $lon2000 = trim($_POST['lon2000']);
    else
        $lon2000 = 0;
    if (isset($_POST['be2000']))
        $be2000 = trim($_POST['be2000']);
    else
        $be2000 = 0;


    $ketqualon = implode(" ", lonHon2000($lon2000)) . " là năm nhuận";
    $ketquabe = implode(" ", beHon2000($be2000)) . " là năm nhuận";

    ?>
    <form action="" method="post">
        <table border="0" cellpadding="0">
            <th colspan="2">
                <h3>Năm nhập vào bé hơn năm 2000</h3>
            </th>
            <tr>
                <td colspan="2" align="center"> TÌM NĂM NHUẬN
                </td>
            </tr>
            <tr>
                <td>Năm:</td>
                <td><input type="number" name="be2000" value="<?php if (isset($_POST['be2000']))
                    echo $be2000; ?>" /></td>
            </tr>
            <tr>
                <td colspan='2' align="center">
                    <textarea name="ketqua" id="ketqua" cols="30" rows="3"
                        style="font-family: 'Times New Roman', Times, serif; font-size: 15px;"><?php echo $ketquabe; ?> </textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="tinhbe2000" size="20"
                        value="  Tìm năm nhuận  " />
                </td>

            </tr>
            <th colspan="2">
                <h3>Năm nhập vào lớn hơn năm 2000</h3>
            </th>
            <tr>
                <td colspan="2" align="center"> TÌM NĂM NHUẬN
                </td>
            </tr>
            <tr>
                <td>Năm:</td>
                <td><input type="number" name="lon2000" value="<?php if (isset($_POST['lon2000']))
                    echo $lon2000; ?>" /></td>
            </tr>
            <tr>
                <td colspan='2' align="center">
                    <textarea name="ketqua" id="ketqua" cols="30" rows="3"
                        style="font-family: 'Times New Roman', Times, serif; font-size: 15px;"><?php echo $ketqualon; ?> </textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="tinhlon2000" size="20"
                        value="  Tìm năm nhuận  " />
                </td>

            </tr>

        </table>
    </form>


</body>

</html>