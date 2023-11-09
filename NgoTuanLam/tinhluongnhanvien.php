<?php include '../templates/header.php'; ?>

<head>
    <style>
        td {
            border: 1px solid;
        }

        h1 {
            text-align: center;
            margin: 5px;
        }

        table {
            background-color: aquamarine;
        }

        #xuly {
            text-align: center;
        }

        tr {
            height: 30px;
        }

        input {
            width: 200px;
        }
    </style>
</head>

<form action="" method="post">
    <table>
        <thead>
            <tr>
                <td colspan="4">
                    <h1>
                        TÍNH LƯƠNG
                    </h1>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Họ tên:</td>
                <td><input style="width: 250px;" type="text" name=""></td>

                <td>Số con:</td>
                <td><input type="number" name=""></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="date" name=""></td>

                <td>Ngày vào làm:</td>
                <td><input type="date" name=""></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td> <input style="width: unset;" type="radio" name="radGT" value="Nam" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nam')
                    echo 'checked="checked"'; ?> checked /> Nam
                    <input style="width: unset;" type="radio" name="radGT" value="Nu" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nu')
                        echo 'checked="checked"'; ?> />Nữ
                </td>

                <td>Hệ số lương:</td>
                <td><input type="number" name=""></td>
            </tr>
            <tr>
                <td>Loại nhân viên:</td>
                <td> <input style="width: unset;" type="radio" name="radLNV" value="Văn phòng" <?php if (isset($_POST['radLNV']) && $_POST['radLNV'] == 'Văn phòng')
                    echo 'checked="checked"'; ?>
                        checked /> Văn phòng</td>
                <td colspan="2"><input style="width: unset;" type="radio" name="radLNV" value="Sản xuất" <?php if (isset($_POST['radLNV']) && $_POST['radLNV'] == 'Sản xuất')
                    echo 'checked="checked"'; ?> /> Sản
                    xuất </td>
            </tr>
            <tr>
                <td></td>
                <td>Số ngày vắng: <input style="width: 100px;" type="number" name=""></td>
                <td colspan="2">Số sản phẩm<input style="width: 100px;" type="number" name=""></td>

            </tr>
            <tr>
                <td colspan="4" style="text-align: center;"><button type="submit">Tính lương</button></td>
            </tr>

            <tr>
                <td>Tiền lương:</td>
                <td><input style="width: 250px;" type="text" name=""></td>

                <td>Trợ cấp:</td>
                <td><input type="number" name=""></td>
            </tr>
            <tr>
                <td>Tiền thưởng:</td>
                <td><input type="text" name=""></td>

                <td>Tiền phạt:</td>
                <td><input type="number" name=""></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;">Thực tính: <input style="width: 100px;" type="number"
                        name=""></td>
            </tr>
        </tbody>
    </table>

</form>
<?php include '../templates/footer.php' ?>