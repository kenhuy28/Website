<?php
session_start(); // Đảm bảo session đã được khởi tạo
include("config.php");

// Import PHPMailer classes vào không gian tên toàn cục
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Bao gồm các tệp PHPMailer
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

/**
 * Hàm để gửi email thông báo hủy đơn hàng
 *
 * @param string $customerEmail Email của khách hàng
 * @param string $customerName Tên của khách hàng
 * @param string $maDonHang Mã đơn hàng
 * @return void
 */
function sendOrderCancellationEmail($customerEmail, $customerName, $maDonHang) {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'anhhuyy2802@gmail.com'; 
        $mail->Password   = 'zofi ilrc gplu jjyp'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587; 

        // Người nhận
        $mail->setFrom('anhhuyy2802@gmail.com', 'T1 Store'); 
        $mail->addAddress($customerEmail, $customerName); 

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Thong Bao Huy Don Hang #' . $maDonHang;

        // Tạo nội dung email
        $body = "
        <h1>Thông báo hủy đơn hàng</h1>
        <p>Xin chào <strong>{$customerName}</strong>,</p>
        <p>Chúng tôi thông báo rằng đơn hàng của bạn với mã số <strong>{$maDonHang}</strong> đã được hủy thành công.</p>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
        <p>Trân trọng,</p>
        <p>Đội ngũ T1 Store</p>
        ";

        $mail->Body    = $body;
        $mail->AltBody = 'Đơn hàng #' . $maDonHang . ' đã được hủy thành công. Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.';

        $mail->send();
    } catch (Exception $e) {
        error_log("Không thể gửi email thông báo hủy đơn hàng: {$mail->ErrorInfo}");
    }
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['taiKhoan']['maKhachHang'])) {
    echo "Bạn cần đăng nhập để thực hiện hành động này.";
    exit;
}

$maDonHang = $_GET['id'];

// Lấy thông tin đơn hàng
$getOrderDetails = $dbh->prepare("SELECT tinhTrang FROM don_dat_hang WHERE maDonHang = :maDonHang AND maKhachHang = :maKhachHang");
$getOrderDetails->execute([
    ':maDonHang' => $maDonHang,
    ':maKhachHang' => $_SESSION['taiKhoan']['maKhachHang']
]);
$orderDetails = $getOrderDetails->fetch(PDO::FETCH_OBJ);

if ($orderDetails) {
    // Kiểm tra trạng thái đơn hàng (nếu chưa được xác nhận, cho phép hủy)
    if ($orderDetails->tinhTrang == 3) { // Giả sử trạng thái "Chưa xác nhận" là 3
        // Cập nhật trạng thái đơn hàng thành đã hủy
        $statement = $dbh->prepare("UPDATE don_dat_hang SET tinhTrang = b'00' WHERE maDonHang = :maDonHang");
        $statement->execute([':maDonHang' => $maDonHang]);

        // Gửi email thông báo hủy đơn hàng
        $customerEmail = $_SESSION["taiKhoan"]["email"];
        $customerName = $_SESSION["taiKhoan"]["hoKhachHang"] . ' ' . $_SESSION["taiKhoan"]["tenKhachHang"];
        sendOrderCancellationEmail($customerEmail, $customerName, $maDonHang);

        header("Location: ../pages/detail_buy_history_page.php?id=$maDonHang&tinhTrang=0"); // Chuyển hướng về trang chi tiết
        exit;
    } else {
        echo "Không thể hủy đơn hàng này."; // Đơn hàng không thể hủy
    }
} else {
    echo "Không tìm thấy đơn hàng hoặc bạn không có quyền truy cập vào đơn hàng này.";
}
?>
