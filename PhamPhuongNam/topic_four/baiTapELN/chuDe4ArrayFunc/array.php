<?php

$cackhoa = array("CNTT" => array("HTTT" => array("Thúy", "Sơn", "Ngà"), "KTPM" => array("Hằng", "Minh", "Ngoan", "Hưng", "Thịnh"), "MMT" => array("Nam", "Phượng", "Huy", "Tuấn Anh")), "NN" => array("BPD" => array("Bình", "Thuần", "Hoa"), "DL" => array("Quỳnh", "Khánh")));

foreach ($cackhoa as $khoa => $nganh) {
    echo "<h2>$khoa</h2>";
    foreach ($nganh as $gv => $dsgv) {
        echo  $gv . " => " ;
        foreach ($dsgv as $ten => $value) {
            echo $value . ", ";
        }
        echo "<br> ";
    }
}

?>
