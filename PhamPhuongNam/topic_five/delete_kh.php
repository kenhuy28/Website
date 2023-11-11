<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>tinh dien tich HCN</title>

    <style type="text/css">
        body {

            background-color: #d24dff;

        }

        form {
            margin: auto;
        }

        table {

            background: #ffd94d;

            border: 0 solid yellow;
            width: 500px;

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

            color: #ff8100;

            font-size: medium;

        }
    </style>

</head>



<body>

    <?php
    require_once("connect.php");
    $Ma_kh = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM khach_hang WHERE Ma_khach_hang = '$Ma_kh'");
    $rows = mysqli_fetch_assoc($result);

    if (isset($_POST['sua'])) {
        $result = mysqli_query($conn, "DELETE FROM khach_hang
        WHERE Ma_khach_hang = '$Ma_kh';");
        echo "xóa thành công";
    }

    ?>

    <form align='center' action="" method="post" enctype="multipart/form-data">
        <table>
            <thead>

                <th colspan="2" align="center">
                    <h3>XÓA THÔNG TIN KHÁCH HÀNG</h3>
                </th>
            </thead>
            <tr>
                <td>Mã khánh hàng:</td>
                <td><input disabled colspan="1" type="text" name="ma" value="<?php echo $rows['Ma_khach_hang']?>" style="width: 100%;" /></td>
            </tr>
            <tr>
                <td>Tên khách hàng:</td>
                <td><input colspan="1" disabled type="text" name="ten" value="<?php echo $rows['Ten_khach_hang']?>" style="width: 100%;" /></td>
            </tr>

            <tr>
                <td>Phái:</td>
                <td><input disabled type="radio" value="0" name="Phai" <?php if ($rows['Phai'] == 0) echo "checked"?> />Nam 
                <input disabled  type="radio" value="1"  name="Phai" <?php if ($rows['Phai'] == 1) echo "checked"?> />Nữ</td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>

                <td><input colspan="1" disabled type="text" value="<?php echo $rows['Dia_chi']?>" style="width: 100%;" name="DC" /></td>

            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td><input colspan="1" disabled type="text" value="<?php echo $rows['Dien_thoai']?>" style="width: 100%;" name="DT" /></td>

            </tr>
            <tr>
                <td>Email:</td>
                <td><input colspan="1" disabled type="text" name="Email" value="<?php echo $rows['Email']?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1"><input type="submit" value="Xóa" name="sua" /></td>
            </tr>

        </table>
    </form>
</body>

</html>