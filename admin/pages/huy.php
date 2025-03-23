<?php
// Bao gồm file kết nối cơ sở dữ liệu
include '../includes/config.php';  // Đảm bảo đường dẫn đúng đến file config.php
include '../templates/nav_admin1.php';
// Kiểm tra nếu có mã đơn hàng truyền vào qua URL
if (!isset($_GET['maDonHang']) || empty($_GET['maDonHang'])) {
    echo "Mã đơn hàng không hợp lệ!";
    exit;
}

$maDonHang = $_GET['maDonHang'];  // Lấy mã đơn hàng từ URL

// Xử lý form khi người dùng gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $lyDo = $_POST['lyDo'];
    $lyDoKhac = $_POST['lyDoKhac'];

    // Tính toán lý do hủy cuối cùng
    $lyDoHuy = $lyDoKhac ?: $lyDo;  // Nếu lý do khác có giá trị, sử dụng lý do khác, ngược lại dùng lý do chọn

    // Cập nhật lý do hủy vào cơ sở dữ liệu
    $query = "UPDATE don_dat_hang SET lyDoHuy = :lyDoHuy, lyDoKhac = :lyDoKhac WHERE maDonHang = :maDonHang";
    $stmt = $dbh->prepare($query);

    // Bind các tham số
    $stmt->bindParam(':lyDoHuy', $lyDoHuy);
    $stmt->bindParam(':lyDoKhac', $lyDoKhac);
    $stmt->bindParam(':maDonHang', $maDonHang);

    // Kiểm tra và thực thi
    if ($stmt->execute()) {
        // Redirect về trang danh sách đơn hàng sau khi cập nhật
        header("Location: order_index.php");
        exit;
    } else {
        // Nếu câu lệnh không thực thi thành công, kiểm tra lỗi
        echo "Đã xảy ra lỗi khi cập nhật lý do hủy.";
        print_r($stmt->errorInfo());  // In ra thông tin lỗi để kiểm tra
    }
} else {
    // Nếu chưa gửi form, hiển thị form nhập lý do hủy
    // Lấy thông tin đơn hàng từ cơ sở dữ liệu để kiểm tra
    $query = "SELECT maDonHang, hoTen FROM don_dat_hang WHERE maDonHang = :maDonHang";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':maDonHang', $maDonHang);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra xem có đơn hàng nào với mã đơn hàng này không
    if (!$order) {
        echo "Không tìm thấy đơn hàng với mã: $maDonHang";
        exit;
    }
}
?>

<div id="cancelFormContainer">
    <!-- Form nhập lý do hủy -->
    <form action="huy.php?maDonHang=<?php echo $maDonHang; ?>" method="POST">
        <h1>Nhập lý do hủy cho đơn hàng mã: <?php echo $maDonHang; ?></h1>
        <label for="lyDo">Lý do hủy:</label>
        <select name="lyDo" id="lyDo">
            <option value="Hết hàng">Hết hàng</option>
            <option value="Quá Thời gian">Quá thời gian</option>
            <option value="Lỗi hàng">Lỗi hàng</option>
            <option value="Không thể giao tới địa chỉ">Không thể giao tới địa chỉ</option>
            <option value="Lý do khác">Lý do khác</option>
        </select>
        <br>
        <label for="lyDoKhac">Lý do khác:</label>
        <input type="text" name="lyDoKhac" id="lyDoKhac" />
        <br>
        <input type="hidden" name="maDonHang" value="<?php echo $maDonHang; ?>"> <!-- Mã đơn hàng sẽ được gán tự động -->
        <input type="submit" value="Gửi lý do hủy">
    </form>
</div>

<?php include '../templates/nav_admin2.php' ?>
<script>
// Khi click vào nút "Lý do hủy" từ order_index, mở trang huy.php và truyền mã đơn hàng
function openCancelForm(maDonHang) {
    window.location.href = "huy.php?maDonHang=" + maDonHang; // Truyền mã đơn hàng qua URL
}
</script>
<style>
/* Căn giữa form trên màn hình */
#cancelFormContainer {
    display: flex;
    justify-content: center;  /* Căn giữa theo chiều ngang */
    align-items: center;      /* Căn giữa theo chiều dọc */
    height: 100vh;            /* Chiếm hết chiều cao của màn hình */
}

/* Form */
form {
    background-color: #fff;  /* Nền trắng cho form */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Đổ bóng nhẹ */
    max-width: 500px;
    width: 100%;
    margin: 20px;
}

/* Tiêu đề form */
h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Các trường nhập liệu */
label {
    font-size: 16px;
    color: #555;
    display: block;
    margin-bottom: 8px;
}

select, input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 16px;
}

/* Nút submit đổi màu thành đỏ */
input[type="submit"] {
    background-color: #f44336; /* Màu đỏ */
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #d32f2f; /* Màu đỏ đậm khi hover */
}

/* Trường hợp lý do hủy khác */
input[type="text"] {
    border-color: #4CAF50;
}

input[type="text"]:focus {
    outline: none;
    border-color: #45a049;
}

select:focus, input[type="text"]:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 5px rgba(72, 189, 82, 0.5);
}

/* Tùy chỉnh cho form khi có lỗi */
input[type="text"]:invalid {
    border-color: red;
}
</style>