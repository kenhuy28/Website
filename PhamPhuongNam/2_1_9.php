<?php
include '../templates/header.php';
?>

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

        input {
            margin-left: -15%;
            width: 100%;
        }

        td {
            padding-left: 5px;
        }
    </style>
<body>
    <?php
   function sapXepTangDan($mang)
   {
       $soPhanTu = count($mang);
   
       for ($i = 0; $i < $soPhanTu - 1; $i++) {
           for ($j = 0; $j < $soPhanTu - $i - 1; $j++) {
               if ($mang[$j] > $mang[$j + 1]) {
                   $temp = $mang[$j];
                   $mang[$j] = $mang[$j + 1];
                   $mang[$j + 1] = $temp;
               }
           }
       }
   
       return $mang;
   }

    function ghepMang($mangA, $mangB) {
        return array_merge($mangA, $mangB);
    }

    $strmangA = "";
    $strmangB = "";
    $strmangC = "";
    $strmangtangdanC = "";
    $strmanggiamdanC = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $strmangA = trim($_POST['strmangA']);
        $mangA = ($strmangA != "") ? explode(",", $strmangA) : [];

        $strmangB = trim($_POST['strmangB']);
        $mangB = ($strmangB != "") ? explode(",", $strmangB) : [];

        $mangC = ghepMang($mangA, $mangB);
        $strmangC = implode(", ", $mangC);

        $mangtangdanC = sapXepTangDan($mangC);
        $strmangtangdanC = implode(", ", $mangtangdanC);

        $manggiamdanC = array_reverse($mangtangdanC);
        $strmanggiamdanC = implode(", ", $manggiamdanC);
    }
    ?>

    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">SẮP XẾP MẢNG</h3>
            </th>
            <tr>
                <td>Mảng A:</td>
                <td><input type="text" name="strmangA" value="<?= $strmangA; ?>"></td>
            </tr>
            <tr>
                <td>Mảng B:</td>
                <td><input type="text" name="strmangB" value="<?= $strmangB; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Thực hiện" style="width: 30%;"></td>
            </tr>
            <tr>
                <td>Số phần tử mảng A:</td>
                <td><input style="width: 30%;" type="text" value="<?= count($mangA); ?>" disabled></td>
            </tr>
            <tr>
                <td>Số phần tử mảng B:</td>
                <td><input style="width: 30%;" type="text" value="<?= count($mangB); ?>" disabled></td>
            </tr>
            <tr>
                <td>Mảng C:</td>
                <td><input type="text" value="<?= $strmangC; ?>" disabled></td>
            </tr>
            <tr>
                <td>Mảng C tăng dần:</td>
                <td><input type="text" value="<?= $strmangtangdanC; ?>" disabled></td>
            </tr>
            <tr>
                <td>Mảng C giảm dần:</td>
                <td><input type="text" value="<?= $strmanggiamdanC; ?>" disabled></td>
            </tr>
        </table>
    </form>
</body>
<?php include '../templates/footer.php' ?>