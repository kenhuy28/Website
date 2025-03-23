<?php
include '../templates/nav_admin1.php';


if (isset($_GET['maPhieuYeuCau'])) {
    $maPhieuYeuCau = $_GET['maPhieuYeuCau'];

    // Lấy thông tin phiếu yêu cầu nhập
    $stmt = $dbh->prepare("SELECT p.*, n.ho, n.ten 
                           FROM phieu_yeu_cau_nhap p
                           JOIN nhan_vien n ON p.maNhanVien = n.maNhanVien 
                           WHERE p.maPhieuYeuCau = :maPhieuYeuCau");
    $stmt->execute(['maPhieuYeuCau' => $maPhieuYeuCau]);
    $request = $stmt->fetch(PDO::FETCH_OBJ);

    // Lấy danh sách sản phẩm trong yêu cầu
    $stmt = $dbh->prepare("SELECT yc.maSanPham, yc.soLuongYeuCau, sp.tenSanPham 
                           FROM yeu_cau_nhap yc
                           JOIN san_pham sp ON yc.maSanPham = sp.maSanPham
                           WHERE yc.maPhieuYeuCau = :maPhieuYeuCau");
    $stmt->execute(['maPhieuYeuCau' => $maPhieuYeuCau]);
    $products = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Lấy tổng số sản phẩm để tính phân trang
    $totalItems = count($products); // Tổng số sản phẩm
    $itemsPerPage = 10; // Số sản phẩm hiển thị mỗi trang
    $totalPages = ceil($totalItems / $itemsPerPage); // Tổng số trang

    // Định nghĩa biến $id
    $id = $maPhieuYeuCau;
}
?>

<div class="body" style="margin-top: 15px">
    <style>
        input {
            font-size: 16px;
        }
        h3 {
            font-size: 20px;
        }
        table {
            border-collapse: collapse;
        }
    </style>
    
    <h1 align="center" class="Title_Admin_create_form">CHI TIẾT PHIẾU YÊU CẦU NHẬP KHO</h1>

    <?php if (isset($request)): ?>
        <div class="form_field" style="width: 50%; float: left;">
            <h3>Mã phiếu yêu cầu</h3>
            <input type="text" class="textfile" readonly value="<?php echo $request->maPhieuYeuCau; ?>" name="MAPHIEUYC">
        </div>
        <div class="form_field" style="width: 50%; float: right;">
            <h3>Ngày yêu cầu</h3>
            <input type="date" class="textfile" id="ngay" value="<?php echo $request->ngayYeuCau; ?>" name="NGAYYC" readonly>
            <span class="error_message"></span>
        </div>
        <div class="form_field" style="width: 50%; float: left;">
            <h3>Nhân viên yêu cầu</h3>
            <input type="text" class="textfile" readonly value="<?php echo $request->ho . ' ' . $request->ten; ?>" name="NVYC">
        </div>
        <table id="productTable" width="100%">
            <tr>
                <th>Sản Phẩm</th>
                <th>Số Lượng Yêu Cầu</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product->tenSanPham; ?></td>
                    <td><?php echo $product->soLuongYeuCau; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div align="center" style="margin-top:10px" class="menu-wrapper">
            <ul class="pagination menu">
                <!-- phân trang -->
                <?php include '../includes/paging_with_id.php' ?>
            </ul>
        </div>
        <div class="button">
            <a href="entry_index.php"><input type="button" value="Quay lại" class="button_add_admin" /></a>
        </div>
    <?php else: ?>
        <p align="center">Phiếu yêu cầu không tồn tại.</p>
    <?php endif; ?>
</div>

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<?php include '../templates/nav_admin2.php' ?>
