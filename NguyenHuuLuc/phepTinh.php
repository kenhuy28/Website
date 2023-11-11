<?php include '../templates/header.php'; ?>

<style>
    label {
        color: red;
    }
</style>

<form action="" method="post">
    <table>
        <thead align="center">
            <th>
                <h3 style="color: blue;">PHÉP TÍNH TRÊN HAI SỐ</h3>
            </th>
        </thead>
        <tbody>
            <tr>
                <td style="color: red;">Chọn phép tính: </td>
                <td>
                    <input type="radio" name="phepTinh" value="+" checked> <label>Cộng</label>
                    <input type="radio" name="phepTinh" value="-"> <label>Trừ</label>
                    <input type="radio" name="phepTinh" value="*"> <label>Nhân</label>
                    <input type="radio" name="phepTinh" value="/"> <label>Chia</label>
                </td>
            </tr>
            <tr>
                <td style="color:blue;">Số thứ nhất:</td>
                <td>
                    <input type="text" name="so1">
                </td>
            </tr>
            <tr>
                <td style="color:blue;">Số thứ hai:</td>
                <td>
                    <input type="text" name="so2">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tính" name="tinh"></td>
            </tr>
        </tbody>
    </table>
</form>
<button type="button" onclick="window.history.go(-1);">Quay lại</button>
<?php if (isset($_POST["tinh"])) {
    if (!isset($_POST["so1"], $_POST["so2"])) {
        echo "<script>alert(\"Nhập thiếu số\");</script>";
    } else {
        $phepTinh = $_POST["phepTinh"];
        $so1 = $_POST["so1"];
        $so2 = $_POST["so2"];
        echo "<script>window.location=\"ketquapheptinh.php?phepTinh=" . $phepTinh . "&so1=" . $so1 . "&so2=" . $so2 . "\"</script>";
    }
} ?>

<?php include '../templates/footer.php' ?>