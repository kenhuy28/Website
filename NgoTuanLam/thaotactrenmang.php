<?php include '../templates/header.php'; ?>
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

        table th {

            background-color: blue;

            font-style: vni-times;

            color: yellow;

        }
    </style>

</head>

<body>
    <?php
    if (isset($_POST['n'])) {
        $n = trim($_POST['n']);
    } else
        $n = 0;
    ?>
    <?php
    function taoMang($soPT)
    {
        $a = array();
        for ($i = 0; $i < $soPT; $i++) {
            $a[$i] = rand(-1000, 1000);
        }
        return $a;
    }
    function hienThiMang($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            echo "$arr[$i], ";
        }
    }
    function soChan($arr)
    {
        $dem = 0;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] % 2 == 0)
                $dem++;
        }
        return $dem;
    }
    function demBe100($arr)
    {
        $dem = 0;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] < 100)
                $dem++;
        }
        return $dem;
    }
    function tongSoAm($arr)
    {
        $dem = 0;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] < 0)
                $dem = $dem + $arr[$i];
        }
        return $dem;
    }

    function kecuoi0($arr)
    {
        $d = 0;
        for ($i = 0; $i < count($arr); $i++) {
            $b = $arr[$i];
            if ($b % 100 < 10 && abs($b) % 100 < 10)
                $d++;
        }
        return $d;
    }
    if (isset($_POST['n']))
        $n = trim($_POST['n']);
    else
        $n = "";
    $kq = " ";
    if (isset($_POST['tinh']) && $n > 0) {
        $a = taoMang($n);
        $str = implode(' ', $a);
        $kq = "Mảng được tạo ra là: " . $str;
        $kq .= "\nSố phần tử chẵn trong mảng: ";
        $kq .= soChan($a);
        $kq .= "\nTổng số âm: ";
        $kq .= tongSoAm($a);
        $kq .= "\nSố số bé hơn 100: ";
        $kq .= demBe100($a);
        $kq .= "\nSố số kề cuối là 0: ";
        $kq .= kecuoi0($a);
    }

    ?>
    <form action="" method="post">

        <table border="0" cellpadding="0">

            <th colspan="2">
                <h2>MỘT SỐ THAO TÁC TRÊN MẢNG</h2>
            </th>

            <tr>

                <td>Nhập N:</td>

                <td><input type="text" name="n" size="30" value="<?php echo $n; ?> " /></td>

            </tr>

            <tr>

                <td colspan="2" align="center"><input type="submit" name="tinh" size="20" value="   XỬ LÝ  " /></td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="ketqua" cols="70" rows="10"><?php echo $kq ?></textarea></td>
            </tr>
        </table>

    </form>

</body>

</html>
<?php include '../templates/footer.php' ?>