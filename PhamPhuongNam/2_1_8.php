<?php
include '../templates/header.php';
?>

    <style type="text/css">
        table {
            background-color: wheat;
            width: 500px;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        th {
            background-color: white;
            font-family: "VNI-Times";
            color: blue;
            padding: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }

        td {
            padding: 5px;
            border: 1px solid #ccc;
        }

        .note {
            text-align: center;
            background-color: yellow;
            padding: 10px;
            font-style: italic;
            font-size: 12px;
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
    $strmangtangdan = "";
    $strmanggiamdan = "";
    if (isset($_POST['strmang'])) {
        $strmang = trim($_POST['strmang']);
        $mang = explode(",", $strmang);
        $mangtangdan = sapXepTangDan($mang);
        $strmangtangdan = implode(", ", $mangtangdan);
        $manggiamdan = array_reverse($mangtangdan);
        $strmanggiamdan = implode(", ", $manggiamdan);
    } 
        
    ?>

    <form action="" method="post">
        <table>
            <tr>
                <th colspan="3">
                    <h3 style="margin-top: 5px;margin-bottom: 5px;">SẮP XẾP MẢNG</h3>
                </th>
            </tr>
            <tr>
                <td>Nhập mảng:</td>
                <td>
                    <input type="text" name="strmang" value="<?php if (isset($_POST['strmang'])) echo $strmang; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Sắp xếp" style="width: 30%;">
                </td>
            </tr>
            <tr>
                <td><span style="color: red; font-weight: bold;">Sau khi sắp xếp:</span></td>
                <td></td>
            </tr>
            <tr>
                <td>Tăng dần:</td>
                <td><input type="text" value="<?php echo  $strmangtangdan; ?>" disabled></td>
            </tr>
            <tr>
                <td>Giảm dần:</td>
                <td><input type="text" value="<?php echo  $strmanggiamdan; ?>" disabled></td>
            </tr>
            <tr>
                <td colspan='2' class="note">
                    <span style="color:red;">(*)</span> Các số được nhập cách nhau bởi dấu ","
                </td>
            </tr>
        </table>
    </form>
</body>
<?php include '../templates/footer.php' ?>