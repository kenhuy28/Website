<?php
include 'config.php';

function generateRequestCode($dbh) {
    $code = 'REQ' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $stmt = $dbh->prepare("SELECT COUNT(*) FROM phieu_yeu_cau_nhap WHERE maPhieuYeuCau = :code");
    $stmt->execute(['code' => $code]);
    return ($stmt->fetchColumn() > 0) ? generateRequestCode($dbh) : $code;
}

if (isset($_POST['maSanPhams']) && isset($_POST['soLuongs'])) {
    $maSanPhams = $_POST['maSanPhams'];
    $soLuongs = $_POST['soLuongs'];
    $maNhanVien = $_POST['maNhanVien'];  // Đảm bảo maNhanVien được truyền từ form
    $ngayYeuCau = date('Y-m-d');
    $maPhieuYeuCau = generateRequestCode($dbh);

    try {
        $dbh->beginTransaction();

        // Lưu vào phieu_yeu_cau_nhap
        $sql = "INSERT INTO phieu_yeu_cau_nhap (maPhieuYeuCau, ngayYeuCau, maNhanVien) VALUES (:maPhieuYeuCau, :ngayYeuCau, :maNhanVien)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(['maPhieuYeuCau' => $maPhieuYeuCau, 'ngayYeuCau' => $ngayYeuCau, 'maNhanVien' => $maNhanVien]);

        // Lưu vào yeu_cau_nhap
        foreach ($maSanPhams as $index => $maSanPham) {
            $soLuong = $soLuongs[$index];
            $sql = "INSERT INTO yeu_cau_nhap (maSanPham, soLuongYeuCau, tinhTrang, maPhieuYeuCau, maNhanVien) VALUES (:maSanPham, :soLuong, 0, :maPhieuYeuCau, :maNhanVien)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(['maSanPham' => $maSanPham, 'soLuong' => $soLuong, 'maPhieuYeuCau' => $maPhieuYeuCau, 'maNhanVien' => $maNhanVien]);
        }

        $dbh->commit();
        echo "Yêu cầu nhập hàng đã được lưu thành công";
    } catch (Exception $e) {
        $dbh->rollBack();
        echo 'Lỗi khi lưu yêu cầu nhập hàng: ' . $e->getMessage();
    }
}
?>
