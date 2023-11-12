<?php
include '../templates/header.php';
?>

    <style>
        td {
            border: 1px solid;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
    function generateMatrix($m, $n)
    {
        $matrix = array();
        for ($i = 0; $i < $m; $i++) {
            $row = array();
            for ($j = 0; $j < $n; $j++) {
                $row[] = rand(-1000, 1000);
            }
            $matrix[] = $row;
        }
        return $matrix;
    }

    function displayMatrix($matrix)
    {
        $result = '';
        foreach ($matrix as $row) {
            foreach ($row as $cell) {
                $result .= $cell . "  " ;
            }
            $result .= "\n"; 
        }
        return $result;
    }   
    function displayEvenRowOddColumn($matrix)
    {
    $result = '';
    for ($i = 0; $i < count($matrix); $i += 2) {
        for ($j = 1; $j < count($matrix[$i]); $j += 2) {
            $result .= $matrix[$i][$j] . "\n";
        }
        $result .= "\n"; 
    }
    return $result;
    }

    function sumMultiplesOfTen($matrix)
    {
        $sum = 0;
        foreach ($matrix as $row) {
            foreach ($row as $cell) {
                if ($cell % 10 == 0) {
                    $sum += $cell;
                }
            }
        }
        return $sum;
    }
    $result = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $m = $_POST['m'];
        $n = $_POST['n'];
        $matrix = generateMatrix($m, $n);
        $result = displayMatrix($matrix);
        $result .= "\n Hiển thị dữ liệu dòng chẳn cột lẻ \n";
        $result .=displayEvenRowOddColumn($matrix);
        $result .= "\n Tính tổng các phần tử là bội số của 10 ". sumMultiplesOfTen($matrix);

    }
    ?>
    <form action="" method="post">
        <table>
            <th colspan="3">
                <h3 style="margin-top: 5px;margin-bottom: 5px;">Mảng hai chiều</h3>
            </th>
            <tr>
                <td>Số dòng (2-5):</td>
                <td><input type="number" name="m" min="2" max="5" required></td>
            </tr>
            <tr>
                <td>Số cột (2-5):</td>
                <td> <input type="number" name="n" min="2" max="5" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tạo ma trận" style="width: 30%;"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><textarea name="" id=""
                        style="min-width: 600px; min-height: 500px;"><?php echo $result; ?></textarea></td>
            </tr>
        </table>
    </form>
</body>

<?php include '../templates/footer.php' ?>