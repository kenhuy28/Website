<?php
include '../includes/config.php';
include '../templates/nav_admin1.php';
include '../includes/check_permisson.php';
check($nv->maLoai, 'YES');
// Lấy tất cả yêu cầu đã được duyệt (approved)

$sql = "
    SELECT ycn.* 
    FROM yeu_cau_nhap ycn
    INNER JOIN phieu_yeu_cau_nhap pycn ON ycn.maPhieuYeuCau = pycn.maPhieuYeuCau
    WHERE pycn.approval_status = 'approved' AND pycn.approval_status != 'added'
"; // Lọc các yêu cầu chưa có trạng thái 'added'
$stmt = $dbh->query($sql);
$requests = $stmt->fetchAll(PDO::FETCH_OBJ);


if (isset($_POST['maPhieuYeuCau'])) {
    $maPhieuYeuCau = $_POST['maPhieuYeuCau'];

    // Kiểm tra trạng thái hiện tại của phiếu yêu cầu
    $sql = "SELECT approval_status FROM phieu_yeu_cau_nhap WHERE maPhieuYeuCau = :maPhieuYeuCau";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(['maPhieuYeuCau' => $maPhieuYeuCau]);
    $status = $stmt->fetchColumn();

    // Kiểm tra trạng thái của phiếu yêu cầu
    if ($status === 'approved') {
        // Cập nhật trạng thái phiếu yêu cầu thành 'added'
        $sql = "UPDATE phieu_yeu_cau_nhap SET approval_status = 'added' WHERE maPhieuYeuCau = :maPhieuYeuCau AND approval_status = 'approved'";
        $stmt = $dbh->prepare($sql);
        
        // Thực thi câu lệnh SQL
        if ($stmt->execute(['maPhieuYeuCau' => $maPhieuYeuCau])) {
            echo "Yêu cầu đã được xác nhận và cập nhật trạng thái thành 'added'.";
        } else {
            echo "Không thể cập nhật trạng thái.";
            print_r($stmt->errorInfo()); // In lỗi nếu có
        }
    } else {
        echo "Trạng thái phiếu yêu cầu không phải 'approved'. Không thể cập nhật.";
    }
}

// Xử lý từ chối yêu cầu
if (isset($_POST['delete_request_id'])) {
    $deleteRequestId = $_POST['delete_request_id'];

    // Xóa yêu cầu từ bảng yeu_cau_nhap
    $sql = "DELETE FROM yeu_cau_nhap WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(['id' => $deleteRequestId]);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác Nhận Yêu Cầu Nhập Hàng</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #c0392b; /* Màu đỏ tươi cho tiêu đề */
            color: white;
        }
        tr:hover {
            background-color: #f2a6a1; /* Màu đỏ nhạt khi hover */
        }
        form {
            display: inline;
        }
        input[type="submit"] {
            background-color: #c0392b; /* Màu đỏ tươi cho nút */
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #a83229; /* Màu đỏ tối hơn khi hover */
        }
    </style>
</head>
<body>
    <h1>Xác Nhận Yêu Cầu Nhập Hàng</h1>
    <table>
        <tr>
            <th>Mã Phiếu Nhập</th>
            <th>Sản Phẩm</th>
            <th>Số Lượng</th>
            <th>Ngày Yêu Cầu</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($requests as $request): ?>
        <tr>
            <td><?php echo $request->id; ?></td> <!-- ID là khóa chính của yêu cầu -->
            <td><?php echo $request->maSanPham; ?></td>
            <td><?php echo $request->soLuongYeuCau; ?></td>
            <td><?php echo date('Y-m-d H:i:s', strtotime($request->ngayYeuCau)); ?></td> <!-- Định dạng ngày -->
            <td>
                <form action="confirm_entry.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $request->id; ?>"> <!-- Gửi ID yêu cầu -->
                    <input type="submit" value="Đồng Ý">
                </form>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="delete_request_id" value="<?php echo $request->id; ?>">
                    <input type="submit" value="Từ Chối">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
