<?php
function getNewProductIds($dbh, $quantity) {
    $maSanPhamPrefix = "SP";
    $query = "SELECT MAX(CAST(SUBSTRING(`maSanPham`, 3) AS SIGNED)) AS max_id FROM `san_pham`";
    $statement = $dbh->prepare($query);
    $statement->execute();
    $maxId = $statement->fetchColumn();

    $newProductIds = [];
    for ($i = 1; $i <= $quantity; $i++) {
        $maxId++; // Tăng giá trị ID
        if ($maxId <= 9) {
            $newProductIds[] = $maSanPhamPrefix . "000" . $maxId;
        } else if ($maxId <= 99) {
            $newProductIds[] = $maSanPhamPrefix . "00" . $maxId;
        } else if ($maxId <= 999) {
            $newProductIds[] = $maSanPhamPrefix . "0" . $maxId;
        } else {
            $newProductIds[] = $maSanPhamPrefix . $maxId;
        }
    }

    return $newProductIds;
}

?>