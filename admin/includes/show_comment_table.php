<?php
// Calculate the total number of pages.
$rowOfPage = 5;

$totalRows = $dbh->query('SELECT COUNT(*) FROM binh_luan')->fetchColumn();
$totalPages = ceil($totalRows / $rowOfPage);

// Determine the current page number.
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Get the rows for the current page.
$query = "
    SELECT binh_luan.maSanPham, san_pham.tenSanPham, khach_hang.hoKhachHang, khach_hang.tenKhachHang, binh_luan.noiDung, binh_luan.ngayGio
    FROM binh_luan
    JOIN san_pham ON binh_luan.maSanPham = san_pham.maSanPham
    JOIN khach_hang ON binh_luan.maKhachHang = khach_hang.maKhachHang
    ORDER BY binh_luan.ngayGio DESC
    LIMIT " . $rowOfPage . " OFFSET " . ($currentPage - 1) * $rowOfPage;

$statement = $dbh->prepare($query);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
$result = $statement->fetchAll();

if ($result) {
    foreach ($result as $row) {
        echo "<tr>
                <td><p>" . htmlspecialchars($row->maSanPham) . "</p></td>
                <td><p>" . htmlspecialchars($row->tenSanPham) . "</p></td>
                <td><p>" . htmlspecialchars($row->hoKhachHang . ' ' . $row->tenKhachHang) . "</p></td>
                <td><p style=\"text-align: justify;\">" . htmlspecialchars($row->noiDung) . "</p></td>
                <td><p>" . htmlspecialchars($row->ngayGio) . "</p></td>
            </tr>";
    }
} else {
    echo "<tr>
            <td colspan=\"5\">Không có dữ liệu</td>
          </tr>";
}
?>
