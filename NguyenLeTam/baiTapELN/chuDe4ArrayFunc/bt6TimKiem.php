<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tim kiem</title>
    <style type="text/css">
        table {
            background-color: wheat;
            width: 500px;
        }

        th {
            background-color: white;
            font-style: vni-times;
            color: blue;
        }

        input {
            margin-left: -15%;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    function timKiem($so, $mang)
    {
        $index=-1;
        for ($i = 0; $i < sizeof($mang); $i++)
            if ($so==$mang[$i]) {
                $index=$i;
                break;
            };
        if ($index==-1)  
            return "Không tìm thấy $so trong mảng";
        else
            return "Đã tìm thấy $so tại vị trí thứ " . ($index+1) . " của mảng";
        
    }
    if (isset($_POST['mang']))
        $mang = trim($_POST['mang']);
    else
        $mang = "0";
    if (isset($_POST['socantim']) && isset($_POST['strmang'])) {
        $socantim = trim($_POST['socantim']);
        $strmang = trim($_POST['strmang']);
        $mang=explode(",",$strmang);
        $dsphantu=implode(", ",$mang);
        $ketquatimkiem=timKiem($socantim, $mang);
    } else {
        $socantim = "";
        $strmang = "";
    }

    ?>
    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">TÌM KIẾM</h3>
            </th>
            <tr>
                <td>Nhập mảng:</td>
                <td>
                    <input type="text" name="strmang" value="<?php if (isset($_POST['strmang']))
                        echo $strmang; ?>">
            </tr>
            <tr>
                <td>Nhập số cần tìm:</td>
                <td>
                    <input type="text" name="socantim" style="width: 30%;" value="<?php if (isset($_POST['socantim']))
                        echo $socantim; ?>">
            </tr>
            <tr>
                <td> </td>
                <td>
                    <input type="submit" value="Tìm kiếm" style="width: 30%;">
                </td>
            </tr>
            <tr>
                <td>Mảng:</td>
                <td><input type="text" value="<?php if (isset($dsphantu))
                echo $dsphantu; ?>" disabled></td>
            </tr>
            <tr>
                <td>Kết quả tìm kiếm:</td>
                <td><input type="text" value="<?php if (isset($ketquatimkiem))
                echo $ketquatimkiem; ?>" disabled></td>
            </tr>
            <tr>
                <td colspan='2' style="text-align: center; background-color: yellow;">
                    <span style="color:red;">(*)</span> Các số được nhập cách nhau bởi dấu ","
                </td>
            </tr>
        </table>
    </form>
</body>

</html>