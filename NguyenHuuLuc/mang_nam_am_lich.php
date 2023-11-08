<?php include '../templates/header.php'; ?>

<head>
    <style type="text/css">
        table {

            color: black;
            background-color: #bbebff;

        }

        th {
            background-color: #0a6ac1;
        }
    </style>
</head>

<?php
function tinhAmLich($n)
{
    $dscan = array("Canh", "Tân", "Nhâm", "Quý", "Giáp", "Ất", "Bính", "Đinh", "Mậu", "Kỷ");
    $dschi = array("Thân", "Dậu", "Tuất", "Hợi", "Tý", "Sửu", "Dần", "Mẹo", "Thìn", "Tị", "Ngọ", "Mùi");
    $kq = "";
    $can = (int) $n % 10;
    $chi = (int) $n % 12;
    $kq .= $dscan[$can] . " " . $dschi[$chi];
    return $kq;
}

function layImg($n)
{
    $dsImg = array("than.jpg", "dau.jpg", "tuat.jpg", "hoi.jpg", "ti.jpg", "suu.jpg", "dan.jpg", "meo.jpg", "thin.jpg", "ty.jpg", "ngo.jpg", "mui.jpg");
    return $dsImg[(int) $n % 12];
}

if (isset($_POST['nam']))
    $nam = trim($_POST['nam']);
else
    $nam = 0;

$ketqua = tinhAmLich($nam);
$img = 'imgNamAmLich/' . layImg($nam);
?>

<body>
    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="padding-top: 15px;">TÍNH NĂM ÂM LỊCH</h3>
            </th>

            <tr>
                <td>Năm Dương lịch:</td>
                <td></td>
                <td>Năm Âm lịch</td>

            </tr>
            <tr>
                <td><input style="width: 80%;" type="number" name="nam" value="<?php if (isset($_POST['nam']))
                    echo $nam; ?>" /></td>
                <td>
                    <button type="submit">=></button>
                </td>
                <td><input style="width: 80%; margin-left:30px;" type="text" name="ketqua" value="<?php if (isset($_POST['ketqua']))
                    echo $ketqua; ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td><img src="<?php echo $img ?>" width="100%"></td>
                <td></td>

            </tr>

        </table>
    </form>
</body>
<?php include '../templates/footer.php' ?>