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
            width: 300px;
        }
    </style>
</head>
<?php
function showBXH()
{
    $strDSBH = $_POST['strDSBH'];
    if (trim($strDSBH) == "")
        return "";
    $strDSBH = trim($strDSBH, ".");
    $strDSBH = str_replace(".", "-", $strDSBH);
    $BXHt = explode("-", $strDSBH);
    $BXH = array();
    for ($i = 0; $i < sizeof($BXHt); $i += 2)
        $BXH[trim($BXHt[$i])] = (int) trim($BXHt[$i + 1]);
    asort($BXH);
    $strBXH = "";
    foreach ($BXH as $key => $value)
        $strBXH .= $key . " - " . $value . "." . "\n";
    return trim($strBXH);
}

if (isset($_POST['themBaiHat']))
    if (isset($_POST['tenBaiHat']) && isset($_POST['thuHang'])) {
        $tenBaiHat = trim($_POST['tenBaiHat']);
        $thuHang = trim($_POST['thuHang']);
        $strDSBH = trim($_POST['strDSBH']);
        $temp = "\n" . $tenBaiHat . " - " . $thuHang . ".";
        if (trim($temp) != "- .")
            $strDSBH .= $temp;
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

</form>