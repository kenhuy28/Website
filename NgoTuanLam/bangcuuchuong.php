<?php include '../templates/header.php'; ?>
<?php

echo "<a style='text-align:center'>BẢNG CỬU CHƯƠNG</a><br>";
echo "<tr>";
for ($i = 2; $i < 10; $i++) {
    echo "<br>";
    echo "Bảng cửu chương " . $i;
    echo "<br>";
    echo "<td>";
    for ($j = 1; $j < 11; $j++) {

        $k = $i * $j;
        echo "$i x $j = $k";
        echo "<br>";

    }
    echo "</td>";
}
echo "</tr>";
?>
<?php include '../templates/footer.php' ?>