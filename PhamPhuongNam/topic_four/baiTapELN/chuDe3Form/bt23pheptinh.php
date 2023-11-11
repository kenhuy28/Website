<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>tinh dien tich HCN</title>

</head>

<body>

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
    <form action="bt23ketquapheptinh.php" method="POST">
        <table>
            <thead>
                <th colspan="2" align="center">
                    <h1>Phép tính trên 2 số</h1>
                </th>

            </thead>
            <tr>
                <td> Chọn phép tính: </td>
                <td>
                    <div style="display: inline-flex;">
                        <input type="radio" name="radPT" value="cong" checked /> Cộng<br>
                        <input type="radio" name="radPT" value="tru"  /> Trừ<br>
                        <input type="radio" name="radPT" value="nhan"  /> Nhân<br>
                        <input type="radio" name="radPT" value="chia"  /> Chia<br>
                    </div>

                </td>
            </tr>
            <tr>
                <td id="so"> Số thứ nhất: </td>
                <td><input type="text" name="a" value="<?php echo $a; ?>" /></td>
            </tr>
            <tr>
                <td id="so"> Số thứ hai: </td>
                <td><input type="text" name="b" value="<?php echo $b; ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="kq" value="Xử lý" /></td>
            </tr>
        </table>


    </form>
</body>

</html>