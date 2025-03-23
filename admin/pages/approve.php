<?php
include '../templates/nav_admin1.php';
include '../includes/check_permisson.php';
check($nv->maLoai, 'APP');
// Lấy danh sách các yêu cầu đang chờ
$stmt = $dbh->prepare("SELECT * FROM phieu_yeu_cau_nhap WHERE approval_status = 'pending'");
$stmt->execute();
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table id="productTable" width="100%">
    <thead>
        <tr>
            <th>Mã Phiếu</th>
            <th>Ngày Yêu Cầu</th>
            <th>Nhân Viên</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?php echo $request['maPhieuYeuCau']; ?></td>
                <td><?php echo $request['ngayYeuCau']; ?></td>
                <td><?php echo $request['maNhanVien']; ?></td>
                <td>
                    <button onclick="updateRequestStatus('<?php echo $request['maPhieuYeuCau']; ?>', 'approved')">Duyệt</button>
                    <button onclick="updateRequestStatus('<?php echo $request['maPhieuYeuCau']; ?>', 'rejected')">Từ chối</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    function updateRequestStatus(maPhieuYeuCau, status) {
    $.ajax({
        url: "../includes/update_request_status.php",
        type: "POST",
        data: { maPhieuYeuCau: maPhieuYeuCau, status: status },
        success: function (response) {
            alert("Yêu cầu đã được " + (status === 'approved' ? "duyệt" : "từ chối"));
            location.reload();
        },
        error: function (error) {
            alert("Lỗi khi cập nhật trạng thái yêu cầu.");
        }
    });
}

</script>