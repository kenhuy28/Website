<?php include("../templates/header.php") ?>
<?php
if (!isset($_SESSION['dsBaiHat'])) {
    $_SESSION['dsBaiHat'] = array();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['themBaiHat'])) {
    $tenBaiHat = isset($_POST['tenBaiHat']) ? trim($_POST['tenBaiHat']) : '';
    $thuHang = isset($_POST['thuHang']) ? intval($_POST['thuHang']) : 0;
    if (!empty($tenBaiHat) && $thuHang > 0)
        $_SESSION['dsBaiHat'][] = array('tenBaiHat' => $tenBaiHat, 'thuHang' => $thuHang);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hienThiBXH'])) {
    // Sắp xếp mảng theo thứ hạng
    usort($_SESSION['dsBaiHat'], function ($a, $b) {
        return $a['thuHang'] - $b['thuHang'];
    });
}
?>

<h1>Thêm bài hát</h1>
<form method="post" action="">
    <label for="tenBaiHat">Tên bái hát:</label>
    <input type="text" name="tenBaiHat">

    <label for="thuHang">Thứ hạng:</label>
    <input type="number" name="thuHang">

    <button type="submit" name="themBaiHat">Thêm bài hát</button>
    <button type="submit" name="hienThiBXH">Hiển thị BXH</button>
</form>

<?php
if (!empty($_SESSION['dsBaiHat'])) {
    echo '<h2>Danh sách bài hát:</h2>';
    echo '<ul>';
    foreach ($_SESSION['dsBaiHat'] as $song) {
        echo "<li>{$song['tenBaiHat']} - thuHang: {$song['thuHang']}</li>";
    }
    echo '</ul>';
}

// Hiển thị bảng xếp hạng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hienThiBXH']) && !empty($_SESSION['dsBaiHat'])) {
    echo '<h2>Bảng xếp hạng:</h2>';
    echo '<table border="1" style="border-collapse: collapse;">';
    echo '<tr><th style="width: 300px;">Tên bài hát</th><th style="width: 100px;">Thứ hạng</th></tr>';
    foreach ($_SESSION['dsBaiHat'] as $song)
        echo "<tr><td>{$song['tenBaiHat']}</td><td style='text-align: center;'>{$song['thuHang']}</td></tr>";
    echo '</table>';
}
?>
<br> 
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>