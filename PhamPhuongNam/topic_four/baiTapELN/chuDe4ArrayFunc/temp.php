<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bảng xếp hạng bài hát</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }
        th, td {
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bảng xếp hạng bài hát</h1>
        <form action="" method="post">
            <label for="tenBaiHat">Tên bài hát:</label>
            <input type="text" name="tenBaiHat" required><br>
            <label for="thuHang">Thứ hạng:</label>
            <input type="number" name="thuHang" required><br>
            <button type="submit" name="themBaiHat">Thêm bài hát</button>
            <button type="submit" name="hienThiBXH">Hiển thị bảng xếp hạng</button>
        </form>

        <?php
        $DSBH = array(); // Mảng lưu danh sách bài hát

        if (isset($_POST['tenBaiHat']) && isset($_POST['thuHang'])) {
            $tenBaiHat = trim($_POST['tenBaiHat']);
            $thuHang = intval($_POST['thuHang']);

            // Thêm bài hát mới vào danh sách
            $DSBH[] = array('tenBaiHat' => $tenBaiHat, 'thuHang' => $thuHang);

            // Sắp xếp danh sách theo thứ hạng
            usort($DSBH, function($a, $b) {
                return $a['thuHang'] - $b['thuHang'];
            });
        }

        if (isset($_POST['hienThiBXH'])) {
            // Hiển thị bảng xếp hạng
            echo '<h2>Bảng xếp hạng bài hát</h2>';
            if (empty($DSBH)) {
                echo '<p>Danh sách bài hát trống.</p>';
            } else {
                echo '<table>';
                echo '<tr><th>Tên bài hát</th><th>Thứ hạng</th></tr>';
                foreach ($DSBH as $baiHat) {
                    echo '<tr><td>' . $baiHat['tenBaiHat'] . '</td><td>' . $baiHat['thuHang'] . '</td></tr>';
                }
                echo '</table>';
            }
        }
        ?>
    </div>
</body>
</html>
