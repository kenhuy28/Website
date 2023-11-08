<?php
if (empty($_POST["baoCao"])) {
    echo "0Đ";
} else {
    $query = "SELECT SUM(tongTien) as doanhThu
    FROM don_dat_hang
    WHERE tinhTrang = b'01' AND MONTH(ngayDat) <= " . $thangKetThuc . " AND YEAR(ngayDat) <= " . $namKetThuc . " AND MONTH(ngayDat) >= " . $thangBatDau . " AND YEAR(ngayDat) >= " . $namBatDau . "";
    $statement = $dbh->prepare($query);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $result = $statement->fetch();
    if ($result) {
        echo $result->doanhThu . "Đ";
    } else {
        echo "Không có dữ liệu</td>
                ";
    }
}
?>