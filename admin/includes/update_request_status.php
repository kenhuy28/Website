<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maPhieuYeuCau'], $_POST['status'])) {
    $maPhieuYeuCau = $_POST['maPhieuYeuCau'];
    $status = $_POST['status'];

    try {
        $stmt = $dbh->prepare("UPDATE phieu_yeu_cau_nhap SET approval_status = :status WHERE maPhieuYeuCau = :maPhieuYeuCau");
        $stmt->execute(['status' => $status, 'maPhieuYeuCau' => $maPhieuYeuCau]);
        echo "success";
    } catch (Exception $e) {
        echo "error";
    }
}
?>
