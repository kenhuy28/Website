<?php include '../templates/header.php'; ?>
<html>

<head>
    <style type="text/css">
        table {

            color: black;
            background-color: #bbebff;

        }

        th {
            background-color: #0a6ac1;
        }
    </style>
</head>

<body>
    <?php
    $ketquabe = "";
    $ketqualon = "";
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
        $lon2000 = 2000;
    if (isset($_POST['be2000']))
        $be2000 = trim($_POST['be2000']);
    else
        $be2000 = 2000;


    $ketqualon = implode(" ", lonHon2000($lon2000)) . " là năm nhuận";
    $ketquabe = implode(" ", beHon2000($be2000)) . " là năm nhuận";

    ?>
    <div style="width:40%;">
        <form action="" method="post">
            <div align="center">
                Năm nhập vảo nhỏ hơn năm 2000
            </div>
            <table border="0" cellpadding="0" width="100%">
                <th colspan="2">
                    <h2>TÌM NĂM NHUẬN</h2>
                </th>
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
            </table>

        </form>
        <table width="100%">
            <div align="center">
                Năm nhập vảo lớn hơn năm 2000
            </div>
            <form method="post">
                <th colspan="2">
                    <h2>TÌM NĂM NHUẬN</h2>
                </th>
                <tr>
                    <td colspan="2" align="center">
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
    </div>
    <button type="button" onclick="window.history.go(-1);">Quay lại</button>
</body>

</html>
<?php include '../templates/footer.php' ?>