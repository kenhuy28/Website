<?php include("../templates/header.php") ?>

<style type="text/css">
    table {
        background: #ffd94d;
        border: 0 solid yellow;
    }

    thead {
        background: #fff14d;
    }

    td {
        color: blue;
    }

    h3 {
        font-family: verdana;
        text-align: center;
        /* text-anchor: middle; */
        color: #c6172e;
        font-size: medium;
    }
</style>

<?php if (isset($_POST['chieudai']))
    $chieudai = trim($_POST['chieudai']);
else
    $chieudai = 0;
if (isset($_POST['chieurong']))
    $chieurong = trim($_POST['chieurong']);
else
    $chieurong = 0;
if (isset($_POST['tinh'])) if (is_numeric($chieudai) && is_numeric($chieurong))
    $dientich = $chieudai * $chieurong;
else {
    echo "<font color='red'>Vui lòng nhập vào số! </font>";
    $dientich = "";
} else
    $dientich = 0; ?>
<form align='center' action="" method="post" style="padding: 10px;">
    <table style="border: 5px solid #d24dff;">
        <thead>
            <th colspan="2" align="center">
                <h3>DIỆN TÍCH HÌNH CHỮ NHẬT</h3>
            </th>
        </thead>
        <tr>
            <td>Chiều dài:</td>
            <td><input type="number" min="0" name="chieudai" value="<?php echo $chieudai; ?>" /></td>
        </tr>
        <tr>
            <td>Chiều rộng:</td>
            <td><input type="number" min="0" name="chieurong" value="<?php echo $chieurong; ?>" /></td>
        </tr>
        <tr>
            <td>Diện tích:</td>
            <td><input type="number" name="dientich" readonly value="<?php echo $dientich; ?>" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><button type="submit">Tính</button></td>
        </tr>
    </table>
</form>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>