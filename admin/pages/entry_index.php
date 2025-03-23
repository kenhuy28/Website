<?php 
include '../templates/nav_admin1.php';
include '../includes/check_permisson.php';
check($nv->maLoai,'NK');
?>

<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="add_admin">
            <a href="entry.php">
                <i class="fa-solid fa-user-plus"></i>
                <div class="add_title">
                    Thêm sản phẩm vào kho
                </div>
            </a>
        </div>
    </div>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th style="width: 65px;">Mã phiếu nhập</th>
                <th style="width: 65px;">Ngày nhập kho</th>
                <th style="width: 65px;">Nhân viên nhập</th>
                <th style="width: 50px;">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <!-- hiển thị bảng nhập kho -->
            <?php include '../includes/show_warehouse_table.php' ?>
        </tbody>
    </table>
    <h2>Danh sách Phiếu Yêu Cầu Nhập Kho</h2>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th style="width: 65px;">Mã phiếu yêu cầu</th>
                <th style="width: 65px;">Ngày yêu cầu</th>
                <th style="width: 65px;">Nhân viên yêu cầu</th>
                <th style="width: 50px;">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $dbh->query("SELECT p.maPhieuYeuCau, p.ngayYeuCau, n.ho AS hoNhanVien, n.ten AS tenNhanVien
                                 FROM phieu_yeu_cau_nhap p
                                 JOIN nhan_vien n ON p.maNhanVien = n.maNhanVien");

            while ($row = $stmt->fetch()) {
                echo "<tr>
                        <td>{$row['maPhieuYeuCau']}</td>
                        <td>{$row['ngayYeuCau']}</td>
                        <td>{$row['hoNhanVien']} {$row['tenNhanVien']}</td>
                        <td><a href='request_details.php?maPhieuYeuCau={$row['maPhieuYeuCau']}'>Xem chi tiết</a></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- phân trang -->
    <?php include $_SESSION['rootPath'] . "/includes/pagination.php" ?>
</div>

<?php include '../templates/nav_admin2.php' ?>