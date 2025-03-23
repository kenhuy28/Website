<?php
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Bao gồm các tệp PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

/**
 * Hàm gửi email thông báo
 *
 * @param string $customerEmail Email của khách hàng
 * @param string $customerName Tên của khách hàng
 * @param string $subject Tiêu đề email
 * @param string $body Nội dung email
 */
function sendEmail($customerEmail, $customerName, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'anhhuyy2802@gmail.com'; // Thay bằng email của bạn
        $mail->Password   = 'zofi ilrc gplu jjyp';   // Thay bằng mật khẩu ứng dụng của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Người nhận
        $mail->setFrom('anhhuyy2802@gmail.com', 'T1 Store');
        $mail->addAddress($customerEmail, $customerName);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
    } catch (Exception $e) {
        error_log("Không thể gửi email: {$mail->ErrorInfo}");
    }
}

$maDonHang = $_GET['id'];
$hanhDong = $_GET['nut'];
// Lấy thông tin khách hàng
$getCustomerInfo = $dbh->prepare("
    SELECT khach_hang.email, CONCAT(khach_hang.hoKhachHang, ' ', khach_hang.tenKhachHang) AS tenKhachHang 
    FROM don_dat_hang 
    JOIN khach_hang ON don_dat_hang.maKhachHang = khach_hang.maKhachHang 
    WHERE don_dat_hang.maDonHang = :maDonHang
");
$getCustomerInfo->execute([':maDonHang' => $maDonHang]);
$customerInfo = $getCustomerInfo->fetch(PDO::FETCH_OBJ);
if ($hanhDong == 'huy') {
    // Lấy dữ liệu lý do hủy từ form
    $lyDo = $_POST['lyDo'];  // Lý do hủy (chọn trong danh sách)
    $lyDoKhac = $_POST['lyDoKhac'];  // Lý do khác nếu có

    // Kiểm tra nếu lý do rỗng, sẽ gán giá trị mặc định
    if (empty($lyDo)) {
        $lyDo = 'Hết hàng';  // Giá trị mặc định nếu không chọn lý do
    }

    // Cập nhật giá trị lý do khác chỉ khi nó không rỗng
    $lyDoKhacValue = !empty($lyDoKhac) ? $lyDoKhac : null;

    // Cập nhật trạng thái đơn hàng và lý do hủy trong cơ sở dữ liệu
    $statement = $dbh->prepare("UPDATE don_dat_hang SET tinhTrang = b'00', lyDoHuy = :lyDoHuy, lyDoKhac = :lyDoKhac, maNhanVien = :maNhanVien WHERE maDonHang = :maDonHang");
    $statement->execute([
        ':lyDoHuy' => $lyDo,
        ':lyDoKhac' => $lyDoKhacValue,
        ':maNhanVien' => $_SESSION['admin']->maNhanVien,
        ':maDonHang' => $maDonHang
    ]);

    // Lấy thông tin khách hàng
    $getCustomerInfo = $dbh->prepare("SELECT khach_hang.email, CONCAT(khach_hang.hoKhachHang, ' ', khach_hang.tenKhachHang) AS tenKhachHang 
                                      FROM don_dat_hang 
                                      JOIN khach_hang ON don_dat_hang.maKhachHang = khach_hang.maKhachHang 
                                      WHERE don_dat_hang.maDonHang = :maDonHang");
    $getCustomerInfo->execute([':maDonHang' => $maDonHang]);
    $customerInfo = $getCustomerInfo->fetch(PDO::FETCH_OBJ);

    // Gửi email thông báo hủy đơn hàng
    if ($customerInfo) {
        $subject = 'Thông báo hủy đơn hàng #' . $maDonHang;
        
        // Nội dung email
        $body = "
        <h1>Thông báo hủy đơn hàng</h1>
        <p>Xin chào <strong>{$customerInfo->tenKhachHang}</strong>,</p>
        <p>Đơn hàng của bạn với mã <strong>{$maDonHang}</strong> đã được hủy.</p>
        <p>Lý do: {$lyDo}</p>";

        // Kiểm tra nếu có lý do khác, sẽ hiển thị lý do khác
        if (!empty($lyDoKhac)) {
            $body .= "<p>Lý do khác: {$lyDoKhac}</p>";
        }

        $body .= "<p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>";
        
        // Gửi email
        if (!sendEmail($customerInfo->email, $customerInfo->tenKhachHang, $subject, $body)) {
            echo "Lỗi khi gửi email!";
        }
    }

} else if ($hanhDong == "xacNhan") {
    // Xác nhận đơn hàng
    $statement = $dbh->prepare("UPDATE don_dat_hang SET tinhTrang = b'10', maNhanVien = :maNhanVien WHERE maDonHang = :maDonHang");
    $statement->execute([
        ':maNhanVien' => $_SESSION['admin']->maNhanVien,
        ':maDonHang' => $maDonHang
    ]);

    // Cập nhật số lượng sản phẩm
    $statement = $dbh->prepare("
        UPDATE san_pham 
        SET soLuong = soLuong - (
            SELECT soLuong 
            FROM chi_tiet_don_dat_hang 
            WHERE san_pham.maSanPham = chi_tiet_don_dat_hang.maSanPham 
            AND maDonHang = :maDonHang
        )
        WHERE maSanPham IN (
            SELECT maSanPham
            FROM chi_tiet_don_dat_hang
            WHERE maDonHang = :maDonHang
        )
    ");
    $statement->execute([':maDonHang' => $maDonHang]);

    // Tính điểm tích lũy
    $getOrderDetails = $dbh->prepare("SELECT tongTien, maKhachHang FROM don_dat_hang WHERE maDonHang = :maDonHang");
    $getOrderDetails->execute([':maDonHang' => $maDonHang]);
    $orderDetails = $getOrderDetails->fetch(PDO::FETCH_OBJ);

    if ($orderDetails) {
        $tongTien = $orderDetails->tongTien;
        $diemTichLuy = floor($tongTien / 1000000);
        $updatePoints = $dbh->prepare("UPDATE khach_hang SET diemTichLuy = diemTichLuy + :diemTichLuy WHERE maKhachHang = :maKhachHang");
        $updatePoints->execute([
            ':diemTichLuy' => $diemTichLuy,
            ':maKhachHang' => $orderDetails->maKhachHang
        ]);
    }

    // Gửi email xác nhận đơn hàng
    if ($customerInfo) {
        $subject = 'Xac nhan don hang #' . $maDonHang;
        $body = "
        <h1>Xác nhận đơn hàng</h1>
        <p>Xin chào <strong>{$customerInfo->tenKhachHang}</strong>,</p>
        <p>Đơn hàng của bạn với mã <strong>{$maDonHang}</strong> đã được xác nhận và đang trong quá trình xử lý.</p>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>";
        sendEmail($customerInfo->email, $customerInfo->tenKhachHang, $subject, $body);
    }

} else {
    // Đơn hàng đã giao
    $statement = $dbh->prepare("UPDATE don_dat_hang SET tinhTrang = b'01', maNhanVien = :maNhanVien WHERE maDonHang = :maDonHang");
    $statement->execute([
        ':maNhanVien' => $_SESSION['admin']->maNhanVien,
        ':maDonHang' => $maDonHang
    ]);

    // Gửi email đã giao hàng
    if ($customerInfo) {
        $subject = 'da giao don hang #' . $maDonHang;
        $body = "
        <h1>Đã giao hàng</h1>
        <p>Xin chào <strong>{$customerInfo->tenKhachHang}</strong>,</p>
        <p>Đơn hàng của bạn với mã <strong>{$maDonHang}</strong> đã được giao thành công.</p>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>";
        sendEmail($customerInfo->email, $customerInfo->tenKhachHang, $subject, $body);
    }
}

header("Location: ../pages/Order_Index.php");
?>