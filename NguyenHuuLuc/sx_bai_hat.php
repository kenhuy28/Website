<?php
include '../templates/header.php';
?>

<head>
    <style>
        h1 {
            text-align: center;
            margin: 5px;
        }

        #xuly {
            text-align: center;
        }

        tr {
            height: 30px;
        }

        input {
            width: 300px;
        }
    </style>
</head>
<?php

// session_start();

function showBXH()
{
    $mang = $_SESSION['baihat'];
    return implode("\n", $mang);
}

if (isset($_POST['themBaiHat']))
    if (isset($_POST['tenBaiHat']) && isset($_POST['thuHang'])) {
        $tenBaiHat = trim($_POST['tenBaiHat']);
        $thuHang = trim($_POST['thuHang']);
        if (empty($_SESSION['baihat'])) {
            $a = array();
            $a[0] = $tenBaiHat;
            $_SESSION['baihat'] = $a;
        } else {
            $baihat = $_SESSION['baihat'];
            $mangMoi = array();
            if ($thuHang > sizeof($baihat)) {
                $baihat[sizeof($baihat)] = $tenBaiHat;
                $mangMoi = $baihat;
            } else {
                $n = 0;
                for ($i = 0; $i < sizeof($baihat); $i++) {
                    if ($i == $thuHang) {
                        $mangMoi[$n] = $tenBaiHat;
                        $i--;
                        $thuHang = 100000;
                    } else {
                        $mangMoi[$n] = $baihat[$i];
                    }
                    $n++;
                }
            }
            $_SESSION['baihat'] = $mangMoi;
        }
    }
if (isset($_POST['hienThiBXH'])) {
    $strBXH = showBXH();
    $strDSBH = $strBXH;
}
?>
<form action="" method="post">
    <table>
        <thead>
            <tr>
                <td colspan="2">
                    <h1>
                        Xếp hạng bài hát
                    </h1>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nhập tên bài hát:</td>
                <td><input type="text" name="tenBaiHat"></td>
            </tr>
            <tr>
                <td>Nhập thứ hạng bài hát:</td>
                <td><input type="number" name="thuHang"></td>
            </tr>
            <tr>
                <td id="xuly" colspan="2"><button type="submit" name="themBaiHat">Thêm bài hát</button></td>
            </tr>
            <tr <?php
            if (!isset($_POST['themBaiHat']))
                echo "hidden";
            ?>>
                <td colspan="2">
                    <textarea name="strDSBH" rows="5" cols="60"><?php if (isset($strDSBH))
                        echo $strDSBH;
                    ?></textarea>
                    <br>
                </td>
            </tr>
            <tr>
                <td id="xuly" colspan="2"><button type="submit" name="hienThiBXH">Hiển thị BXH</button></td>
            </tr>
            <tr <?php
            if (!isset($_POST['hienThiBXH']))
                echo "hidden";
            ?>>
                <td colspan="2"> <textarea name="strBXH" rows="5" cols="60"><?php if (isset($strBXH))
                    echo $strBXH; ?></textarea></td>
            </tr>
        </tbody>
    </table>
    <button type="button" onclick="window.history.go(-1);">Quay lại</button>
</form>
<?php include '../templates/footer.php' ?>