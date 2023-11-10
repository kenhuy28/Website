<?php
// Calculate the total number of pages.
$rowOfPage = 10;

$totalRows = $dbh->query('SELECT COUNT(*) FROM don_dat_hang')->fetchColumn();
$totalPages = ceil($totalRows / $rowOfPage);

// Determine the current page number.
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Get the rows for the current page.

$query = "SELECT don_dat_hang.*, CONCAT(khach_hang.hoKhachHang, ' ', khach_hang.tenKhachHang) AS tenKhachHang, 
CONCAT(nhan_vien.ho, ' ', nhan_vien.ten) AS tenNhanVien FROM don_dat_hang 
JOIN khach_hang ON khach_hang.maKhachHang = don_dat_hang.maKhachHang
LEFT JOIN nhan_vien ON nhan_vien.maNhanVien = don_dat_hang.maNhanVien
ORDER BY tinhTrang DESC, ngayDat ASC, maDonHang ASC 
LIMIT " . $rowOfPage . " OFFSET " . ($currentPage - 1) * $rowOfPage;
$statement = $dbh->prepare($query);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
$result = $statement->fetchAll();
if ($result) {
    foreach ($result as $row) {
        $tinhTrang = "";
        $btn = "";
        $btnHuy = "<form action='../includes/process_order.php?id=" . $row->maDonHang . "&nut=huy' method='post'>
            <input class=\"btn-danger\" type='submit' value=\"Hủy đơn\" >
        </form>";

        $btnXacNhan = "<form action='../includes/process_order.php?id=" . $row->maDonHang . "&nut=xacNhan' method='post'>
        <input class=\"btn-success\" type='submit' value=\"Xác nhận\" >
    </form>";
        $btnGiao = "<form action='../includes/process_order.php?id=" . $row->maDonHang . "&nut=giao' method='post'>
        <input class=\"btn-primary\" type='submit' value=\"Đã giao\" >
    </form>";

        if ($row->tinhTrang == 0) {
            $tinhTrang = "<p style=\"color:red;\">Đơn hàng bị hủy</p>";
        } else if ($row->tinhTrang == 1) {
            $tinhTrang = "<p style=\"color:blue;\">Đã giao</p>";
        } else if ($row->tinhTrang == 2) {
            $tinhTrang = "<p style=\"color:green;\">Đã xác nhận (Đang giao)</p>";
            $btn = $btnGiao;
        } else {
            $tinhTrang = "<p>Chưa xác nhận</p>";
            $btn = $btnXacNhan . $btnHuy;
        }


        echo "<tr>
                            <td><p>" . $row->maDonHang . "</p></td>
                            <td><p>" . $row->tenKhachHang . "</p></td>
                            <td><p>" . $row->ngayDat . "</p></td>
                            <td><p>" . $row->ngayGiao . "</p></td>
                            <td><p>" . $row->tongTien . "</p></td>
                            <td>" . $tinhTrang . "</td>
                            <td><p>" . $row->tenNhanVien . "</p></td>
                            <td>
                                <a href=\"Order_Details.php?id=" . $row->maDonHang . "\" ><i class=\"fa-solid fa-circle-info detail\"></i></a>
                            </td>
                            <td>" . $btn . "</td>
                        </tr>";
    }
} else {
    echo "<tr>
                <td colspan=\"10\">Không có dữ liệu</td>
                </tr>";
}
?>