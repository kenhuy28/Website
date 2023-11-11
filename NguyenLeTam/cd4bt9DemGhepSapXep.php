<?php include("../templates/header.php") ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sắp xếp</title>
    <style type="text/css">
        table {
            background-color: wheat;
            width: 500px;
        }

        th {
            background-color: white;
            color: blue;
            font-family: 'Courier New', Courier, monospace;
        }

        td {
            padding-left: 5px;
        }
    </style>
</head>

<?php
function swap(&$so1, &$so2)
{
    $so1 += $so2;
    $so2 = $so1 - $so2;
    $so1 = $so1 - $so2;
}
function sapXepTangDan($mang)
{
    $soPhanTu = sizeof($mang);
    for ($i = 0; $i < $soPhanTu; $i++)
        for ($j = 0; $j < $soPhanTu; $j++)
            if ($mang[$i] < $mang[$j])
                swap($mang[$i], $mang[$j]);
    return $mang;
}
function ghepMang($mangA, $mangB)
{
    $soluongB = sizeof($mangB);
    $mangC = $mangA;
    for ($i = 0; $i < $soluongB; $i++)
        $mangC[] = $mangB[$i];
    return $mangC;
}

if (isset($_POST['strmangA']) && isset($_POST['strmangB'])) {
    $strmangA = trim($_POST['strmangA']);
    if ($strmangA != "")
        $mangA = explode(",", $strmangA);
    else
        $mangA = array();
    $strmangB = trim($_POST['strmangB']);
    if ($strmangA != "")
        $mangB = explode(",", $strmangB);
    else
        $mangB = array();
    $mangC = ghepMang($mangA, $mangB);
    $strmangC = implode(", ", $mangC);
    $mangtangdanC = sapXepTangDan($mangC);
    $strmangtangdanC = implode(", ", $mangtangdanC);
    $manggiamdanC = array_reverse($mangtangdanC);
    $strmanggiamdanC = implode(", ", $manggiamdanC);
} else {
    $strmangA = "";
    $strmangB = "";
    $strmangC = "";
    $strmangtangdanC = "";
    $strmanggiamdanC = "";
}


?>
<form action="" method="post">
    <table>
        <th colspan="3">
            <h3 style="margin-top: 5px;margin-bottom: 5px;">SẮP XẾP MẢNG</h3>
        </th>
        <tr>
            <td>Mảng A:</td>
            <td>
                <input type="text" name="strmangA" style="width: 90%;" value="<?php if (isset($_POST['strmangA']))
                    echo $strmangA; ?>"><span style="color:red;">(*)</span> 
        </tr>
        <tr>
            <td>Mảng B:</td>
            <td>
                <input type="text" name="strmangB" style="width: 90%;" value="<?php if (isset($_POST['strmangB']))
                    echo $strmangB; ?>"><span style="color:red;">(*)</span> 
        </tr>
        <tr>
            <td> </td>
            <td>
                <input type="submit" value="Thực hiện" style="width: 30%;">
            </td>
        </tr>

        <tr>
            <td>Số phần tử mảng A:</td>
            <td><input style="width: 30%;" type="text" value="<?php if (isset($_POST['strmangA']))
                echo sizeof($mangA); ?>" readonly></td>
        </tr>
        <tr>
            <td>Số phần tử mảng B:</td>
            <td><input style="width: 30%;" type=" text" value="<?php if (isset($_POST['strmangB']))
                echo sizeof($mangB); ?>" readonly></td>
        </tr>
        <tr>
            <td>Mảng C:</td>
            <td><input type="text" style="width: 100%;" value="<?php
            echo $strmangC; ?>" readonly></td>
        </tr>
        <tr>
            <td>Mảng C tăng dần:</td>
            <td><input type="text" style="width: 100%;" value="<?php
            echo $strmangtangdanC; ?>" readonly></td>
        </tr>
        <tr>
            <td>Mảng C giảm dần:</td>
            <td><input type="text" style="width: 100%;" value="<?php
            echo $strmanggiamdanC; ?>" readonly></td>
        </tr>
        <tr>
            <td colspan='2' style="text-align: center; background-color: yellow;">
                <span style="color:red;">(*)</span> Các số được nhập cách nhau bởi dấu ","
            </td>
        </tr>
    </table>
</form>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>