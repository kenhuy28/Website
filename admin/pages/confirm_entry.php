<?php
include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    if (isset($_POST['reject'])) {
        // Xóa yêu cầu nhập hàng nếu từ chối
        $sqlDeleteRequest = "DELETE FROM yeu_cau_nhap WHERE id = :id";
        $stmtDelete = $dbh->prepare($sqlDeleteRequest);
        $stmtDelete->execute(['id' => $id]);

        // Chuyển hướng về trang xác nhận với thông báo
        header("Location: confirm_requests.php?rejected=1");
        exit();
    } else {
        // Xác nhận yêu cầu như ban đầu
        $sql = "SELECT * FROM yeu_cau_nhap WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(['id' => $id]);
        $request = $stmt->fetch(PDO::FETCH_OBJ);

        // Cập nhật số lượng sản phẩm
        $sqlUpdateStock = "UPDATE san_pham SET soLuong = soLuong + :soLuongYeuCau WHERE maSanPham = :maSanPham";
        $stmtUpdateStock = $dbh->prepare($sqlUpdateStock);
        $stmtUpdateStock->execute([
            'soLuongYeuCau' => $request->soLuongYeuCau,
            'maSanPham' => $request->maSanPham
        ]);

        // Cập nhật trạng thái yêu cầu
        $sqlUpdateRequest = "UPDATE yeu_cau_nhap SET tinhTrang = 1 WHERE id = :id";
        $stmtUpdateRequest = $dbh->prepare($sqlUpdateRequest);
        $stmtUpdateRequest->execute(['id' => $id]);

        // Cập nhật approval_status thành 'added' trong bảng phieu_yeu_cau_nhap
          $sqlUpdateApprovalStatus = "UPDATE phieu_yeu_cau_nhap SET approval_status = 'added' WHERE maPhieuYeuCau = :maPhieuYeuCau";
          $stmtUpdateApprovalStatus = $dbh->prepare($sqlUpdateApprovalStatus);
          $stmtUpdateApprovalStatus->execute(['maPhieuYeuCau' => $request->maPhieuYeuCau]);  

        header("Location: confirm_requests.php?success=1");
        exit();
    }
}
