<?php
if (isset($_POST["cancel"])) {
    echo "1111";
}
// Calculate the total number of pages.
$rowOfPage = 10;

$totalRows = $dbh->query('SELECT COUNT(*) FROM don_dat_hang')->fetchColumn();
$totalPages = ceil($totalRows / $rowOfPage);

// Determine the current page number.
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Get the rows for the current page.

$query = "SELECT don_dat_hang.*, CONCAT(khach_hang.hoKhachHang, ' ', khach_hang.tenKhachHang) AS tenKhachHang, CONCAT(nhan_vien.ho, ' ', nhan_vien.ten) AS tenNhanVien FROM don_dat_hang 
JOIN khach_hang ON khach_hang.maKhachHang = don_dat_hang.maKhachHang
JOIN nhan_vien ON nhan_vien.maNhanVien = don_dat_hang.maNhanVien
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
        $btnHuy = "<button type=\"button\" class=\"btn-danger\" style=\"margin-left: 10px;\" onclick=\"$.ajax({
            url: '../includes/process_order.php',
            data: {id: '" . $row->maDonHang . "'},
            success: function(data) {
              
            },
            error: function(error) {
              // Xử lý lỗi
              alert(\"Có lỗi xảy ra\");
            }
          });\">Hủy</button>";
        $btnXacNhan = "<button type=\"button\" class=\"btn-success\">Xác nhận</button>";
        $btnGiao = "<button type=\"button\" class=\"btn-primary\" >Đã giao</button>";

        if ($row->tinhTrang == 0) {
            $tinhTrang = "<p style=\"color:red;\">Đơn hàng bị hủy</p>";
        } else if ($row->tinhTrang == 1) {
            $tinhTrang = "<p style=\"color:blue;\">Đã giao</p>";
        } else if ($row->tinhTrang == 2) {
            $tinhTrang = "<p style=\"color:green;\">Đã xác nhận</p>";
            $btn = $btnGiao . '<br>' . $btnHuy;

        } else {
            $tinhTrang = "<p>Chưa xác nhận</p>";
            $btn = $btnXacNhan . ' ' . $btnHuy;
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
                                <a><i class=\"fa-solid fa-circle-info detail\"></i></a>
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