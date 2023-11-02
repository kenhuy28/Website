<?php
if (isset($_POST["delete"])) {
    echo "1";
    $statement = $dbh->prepare("SELECT * FROM `chi_tiet_don_dat_hang` WHERE `maSanPham` = '" . $product_id . "'");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $result = $statement->fetch();

    if ($statement->rowCount() == 0) {
        $statement = $dbh->prepare("DELETE FROM `san_pham` WHERE `maSanPham` = '" . $product_id . "'");
        $statement->execute();

    } else {
        echo "<script>
            alert(\"Sản phẩm đang có sản phẩm kinh doanh\");
        </script>";

    }
    echo '<script>window.location.href = "product_index.php";</script>';
}
?>