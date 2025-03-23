<?php
include '../templates/nav_admin1.php';
include '../includes/check_permisson.php';
check($nv->maLoai, 'KHO');

// Cấu hình số dòng hiển thị trên mỗi trang
$rowOfPage = 10;

// Tính tổng số trang
$totalRows = $dbh->query('SELECT COUNT(*) FROM san_pham')->fetchColumn();
$totalPages = ceil($totalRows / $rowOfPage);

// Xác định trang hiện tại
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Truy vấn lấy sản phẩm và kiểm tra tồn kho
$query = "SELECT *, tenThuongHieu, tenLoai FROM `san_pham`
JOIN thuong_hieu ON thuong_hieu.maThuongHieu = san_pham.maThuongHieu
JOIN loai_san_pham ON loai_san_pham.maLoai = san_pham.maLoai 
ORDER BY maSanPham ASC
LIMIT " . $rowOfPage . " OFFSET " . ($currentPage - 1) * $rowOfPage;
$statement = $dbh->prepare($query);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
$result = $statement->fetchAll();
?>

<div class="body" style="margin-top: 15px">
    <h1>Kho sản phẩm</h1>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Thương hiệu</th>
                <th>Loại</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {
                foreach ($result as $row) {
                    $stockStatus = '';
                    if ($row->soLuong > 10) {
                        $stockStatus = '<span style="color: green;">Còn hàng nhiều</span>';
                    } elseif ($row->soLuong > 0 && $row->soLuong <= 10) {
                        $stockStatus = '<span style="color: orange;">Sắp hết hàng</span>';
                    } else {
                        $stockStatus = '<span style="color: red;">Hết hàng - Cần bổ sung</span>';
                    }

                    echo "<tr>
                        <td><p>{$row->maSanPham}</p></td>
                        <td><p>{$row->tenSanPham}</p></td>
                        <td>
                            <img src=\"" . $_SESSION['rootPath'] . "/../assets/img/sanpham/" . $row->hinhAnh . "\" style=\"width: 80px; height: 80px;\">
                        </td>
                        <td><p>{$row->soLuong}</p></td>
                        <td><p>{$row->tenThuongHieu}</p></td>
                        <td><p>{$row->tenLoai}</p></td>
                        <td>{$stockStatus}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan=\"7\">Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php include '../includes/pagination.php' ?>
</div>
<?php include '../templates/nav_admin2.php' ?>
