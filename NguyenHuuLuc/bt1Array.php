<?php include '../templates/header.php'; ?>
<html>

<head>
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
    function hienThiMang($mang)
    {
        echo "<br> ";
        echo "Các phần tử của mảng: ";
        echo $mang[0];
        for ($i = 1; $i < sizeof($mang); $i++) {
            echo ", " . $mang[$i];
        }
        echo "<br> ";
    }

    function demSoChan($mang)
    {
        $dem = 0;
        for ($i = 0; $i < sizeof($mang); $i++)
            if ($mang[$i] % 2 == 0)
                $dem++;

        return $dem;
    }

    function demSoBeHon100($mang)
    {
        $dem = 0;
        for ($i = 0; $i < sizeof($mang); $i++)
            if ($mang[$i] < 100)
                $dem++;
        return $dem;
    }
    function tongSoBeHon0($mang)
    {
        $tong = 0;
        for ($i = 0; $i < sizeof($mang); $i++)
            if ($mang[$i] < 0)
                $tong += $mang[$i];
        return $tong;
    }
    function demSoKeCuoiLa0($mang)
    {
        $temp = "";
        for ($i = 0; $i < sizeof($mang); $i++)
            if (abs($mang[$i]) % 100 < 10)
                $temp .= $i . " ";
        return $temp;
    }
    function swap(&$so1, &$so2)
    {
        $so1 += $so2;
        $so2 = $so1 - $so2;
        $so1 = $so1 - $so2;
    }
    function sapXepTangDan(&$mang)
    {
        $soPhanTu = sizeof($mang);
        for ($i = 0; $i < $soPhanTu; $i++)
            for ($j = $i + 1; $j < $soPhanTu; $j++) {
                if ($mang[$i] > $mang[$j]) {
                    swap($mang[$i], $mang[$j]);
                }
            }
    }
    function taoMang($n)
    {
        $a = array();
        for ($i = 0; $i < $n; $i++)
            $a[$i] = rand(-1000, 1000);
        return $a;
    }

    if (isset($_POST['n']))
        $n = trim($_POST['n']);
    else
        $n = 0;
    $ketqua = "";
    if (isset($_POST['tinh'])) {
        $n = (int) $_POST["n"];
        $a = taoMang($n);
        $str = implode("  ", $a);
        $ketqua = "Mảng được tạo ra là: " . $str;
        $ketqua .= "\nSố phần tử chẵn là " . demSoChan($a);
        $ketqua .= "\nSố phần tử có giá trị là số nhỏ hơn 100 " . demSoBeHon100($a);
        $ketqua .= "\nTổng của các thành phần trong mảng giá trị là số âm " . tongSoBeHon0($a);
        $ketqua .= "\nVị trí của các thành phần trong mảng có chữ số kề cuối là 0: " . demSoKeCuoiLa0($a);
        sapXepTangDan($a);
        $str = implode("  ", $a);
        $ketqua .= "\nSắp xếp các số đó theo thứ tự tăng dần: " . $str;
    }
    ?>
    <form action="" method="post">
        <table border="0" cellpadding="0">
            <th colspan="2">
                <h2>THAO TÁC TRÊN MẢNG</h2>
            </th>
            <tr>
                <td>Nhập mảng:</td>
                <td><input type="text" name="n" width="40" value="<?php if (isset($_POST['n']))
                    echo $n; ?>" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="tinh" size="20" value="  Xử lý  " /></td>

            </tr>
            <tr>
                <td colspan='2'><textarea name="ketqua" id="ketqua" cols="40" rows="10"
                        style="font-family: 'Times New Roman', Times, serif; font-size: 15px;"><?php echo $ketqua; ?> </textarea>
                </td>
            </tr>
        </table>
    </form>


</body>

</html>
<?php include '../templates/footer.php' ?>