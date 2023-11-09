<?php include '../templates/header.php'; ?>
<?php
$a = rand(1, 4);
$b = rand(10, 100);
echo "a=$a ; b=$b <br>";
switch ($a) {
    case 1:
        echo "<br>Chu vi hình vuông có độ dài cạnh là $b là: " . $b * 4;
        echo "<br>Diện tích hình vuông có cạnh là $b là: " . pow($b, 2);
        break;
    case 2:
        echo "<br>Chu vi hình tròn có bán kính là $b là: " . 2 * 3.14 * $b;
        echo "<br>Diện tích hình tròn có bán kính là $b là: " . 3.14 * $b * $b;
        break;
    case 3:
        echo "<br>Chu vi tam giác đều có cạnh là $b là: " . 3 * $b;
        echo "<br>Diện tích tam giác đều có cạnh là $b là: " . round(sqrt(3) / 4 * pow($b, 2), 2);
        break;
    case 4:
        echo "<br>Chu vi hình chữ nhật có cạnh là $a và $b: là" . ($a + $b) * 2;
        echo "<br>Diện tích hình chữ nhật có cạnh là $a và $b là" . $a * $b;
}
?>

<?php include '../templates/footer.php' ?>