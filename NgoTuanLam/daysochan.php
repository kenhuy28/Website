<?php include '../templates/header.php'; ?>
<?php
$n = rand(1, 100);
echo "<br>Các giá trị chẵn bé hơn $n là: ";
for ($i = 0; $i < $n; $i++) {
    if ($i % 2 == 0) {
        echo " $i";
    }
}
?>

<?php include '../templates/footer.php' ?>