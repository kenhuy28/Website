<?php include '../templates/header.php'; ?>
<?php
$r = rand(1, 1000);
echo "Số N là $r";
echo "<br>";
if ($r < 2) {
    echo "Không phải";
}
$count = 0;
for ($i = 2; $i <= sqrt($r); $i++) {
    if ($r % $i == 0) {
        $count++;
    }
}
if ($count == 0) {
    echo "$r là số nguyên tố";
} else {
    echo "không phải là số nguyên tố <br>";
}

?>
<?php include '../templates/footer.php' ?>