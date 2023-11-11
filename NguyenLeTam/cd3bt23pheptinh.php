<?php include("../templates/header.php") ?>
<?php
if (isset($_POST['a']))
    $a = trim($_POST['a']);
else
    $a = "";
if (isset($_POST['b']))
    $b = trim($_POST['b']);
else
    $b = "";
?>
<form action="cd3bt23ketquapheptinh.php" method="POST">
    <table style="font-size: 20px;">
        <thead>
            <th colspan="2" align="center">
                <h1>Phép tính trên 2 số</h1>
            </th>

        </thead>
        <tr>
            <td style="color: brown;"> <b>Chọn phép tính : </b></td>
            <td>
                <div style="display: inline-flex; color: red;">
                    <input type="radio" name="radPT" value="cong" checked /> Cộng<br>
                    <input type="radio" name="radPT" value="tru" /> Trừ<br>
                    <input type="radio" name="radPT" value="nhan" /> Nhân<br>
                    <input type="radio" name="radPT" value="chia" /> Chia<br>
                </div>

            </td>
        </tr>
        <tr>
            <td style="color: dodgerblue; text-align: right;"> <b>Số thứ nhất : </b></td>
            <td><input type="number" min="0" name="a" value="<?php echo $a; ?>" /></td>
        </tr>
        <tr>
            <td style="color: dodgerblue; text-align: right;"> <b>Số thứ hai : </b></td>
            <td><input type="number" min="0" name="b" value="<?php echo $b; ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="kq">Xử lý</button></td>
        </tr>
    </table>
</form>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>