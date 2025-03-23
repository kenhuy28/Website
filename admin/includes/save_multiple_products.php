<?php
require_once 'config.php';
var_dump($_POST);
var_dump($_SESSION['uploaded_images']);

$categoryMapping = [
    'banphim' => 'Bàn phím',
    'camera' => 'Camera',
    'chuot' => 'Chuột',
    'dienthoai' => 'Điện thoại',
    'dongho' => 'Đồng hồ',
    'laptop' => 'Laptop',
    'mayin' => 'Máy in'
];

// Kiểm tra xem session có chứa dữ liệu cần thiết không
if (!isset($_SESSION['uploaded_images']) || !isset($_SESSION['categories'])) {
    echo "Không có sản phẩm hoặc loại sản phẩm để lưu!<br>";
    var_dump($_SESSION['uploaded_images']); // Kiểm tra dữ liệu ảnh
    var_dump($_SESSION['categories']);     // Kiểm tra dữ liệu loại sản phẩm
    exit; // Kết thúc script nếu không có dữ liệu
}

// Lấy dữ liệu từ session
$uploadedImages = $_SESSION['uploaded_images'];
$categories = $_SESSION['categories'];

// Kiểm tra nếu dữ liệu trong session không rỗng
if (empty($uploadedImages) || empty($categories)) {
    echo "Không có sản phẩm hoặc loại sản phẩm để lưu!<br>";
    var_dump($uploadedImages);
    var_dump($categories);
    exit;
}
// Kiểm tra nếu có ảnh được tải lên
if (isset($_FILES['images'])) {
    $file = $_FILES['images'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    if ($file_error === 0) {
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    
        if (in_array($file_ext, $allowed_ext)) {
            $new_file_name = $file_name; // Giữ nguyên tên file gốc
    
            // Đặt đường dẫn đến thư mục lưu trữ ảnh
            $file_destination = "../assets/img/sanpham/" . $new_file_name;
    
            if (move_uploaded_file($file_tmp, $file_destination)) {
                // Chỉ lưu tên file vào session, không gửi đường dẫn đầy đủ
                $_SESSION['uploaded_images'] = [
                    'image' => $new_file_name, // Chỉ lưu tên file ảnh (ví dụ: 'Lapmagaming.jpg')
                    'category' => $_POST['category'] // Hoặc các thông tin khác nếu cần
                ];
            } else {
                echo "Không thể tải lên ảnh.";
                exit;
            }
        } else {
            echo "Loại file không hợp lệ.";
            exit;
        }
    } else {
        echo "Có lỗi khi tải lên ảnh.";
        exit;
    }    
}

// Kiểm tra nếu dữ liệu hình ảnh vẫn còn trong session
if (isset($_SESSION['uploaded_images']) && is_array($_SESSION['uploaded_images'])) {
    $uploadedImages = $_SESSION['uploaded_images'];  // Dữ liệu hình ảnh vẫn còn trong session
} else {
    echo "Không có hình ảnh để lưu!";
    exit;
}

foreach ($uploadedImages as $index => $product) {
    $imagePath = $product['image'];  // Lấy đường dẫn ảnh từ session
    
    // Mảng ánh xạ category từ tên (chuot, laptop, ...) sang maLoai
    $categoryMapping = [
        'banphim' => 'LSP005',
        'camera' => 'LSP007',
        'chuot' => 'LSP006',
        'dienthoai' => 'LSP001',
        'dongho' => 'LSP003',
        'laptop' => 'LSP002',
        'mayin' => 'LSP004'
    ];

    // Lấy giá trị category từ $_POST
    $categoryFullName = $_POST['category'][$index] ?? ''; 

    // Kiểm tra nếu category có trong mảng ánh xạ
    if (isset($categoryMapping[$categoryFullName])) {
        // Ánh xạ thành maLoai hợp lệ
        $maLoai = $categoryMapping[$categoryFullName];
    } else {
        // Nếu không có trong ánh xạ, thông báo lỗi và dừng
        echo "Danh mục sản phẩm không hợp lệ cho sản phẩm thứ $index!";
        exit;
    }

    // Kiểm tra dữ liệu từ form
    $tenSanPham = $_POST['TENSP'][$index] ?? '';
    $donGiaBan = $_POST['DONGIABAN'][$index] ?? '';
    $maThuongHieu = $_POST['MATH'][$index] ?? '';
    $moTa = $_POST['MOTA'][$index] ?? '';
    $maSanPham = $_POST['MASP'][$index] ?? ''; 

    // Kiểm tra các trường cần thiết
    $errors = [];
    if (empty($tenSanPham)) { $errors[] = "Tên sản phẩm"; }
    if (empty($donGiaBan)) { $errors[] = "Đơn giá bán"; }
    if (empty($maThuongHieu)) { $errors[] = "Mã thương hiệu"; }
    if (empty($maLoai)) { $errors[] = "Danh mục sản phẩm"; }
    if (empty($imagePath)) { $errors[] = "Hình ảnh sản phẩm"; }
    if (empty($maSanPham)) { $errors[] = "Mã sản phẩm"; }

    if (!empty($errors)) {
        echo "Dữ liệu sản phẩm không đầy đủ cho sản phẩm thứ $index:<br>";
        echo implode(", ", $errors); // In các lỗi thiếu
        echo "<br>";
        continue; // Bỏ qua sản phẩm nếu thiếu dữ liệu
    }
$imageName = basename($imagePath); // Lấy tên ảnh (không có đường dẫn)
    // Câu lệnh SQL để lưu sản phẩm vào cơ sở dữ liệu
$query = "INSERT INTO san_pham 
(maSanPham, tenSanPham, donGiaMua, donGiaBan, maThuongHieu, maLoai, soLuong, hinhAnh, moTa) 
VALUES 
(:maSanPham, :tenSanPham, :donGiaMua, :donGiaBan, :maThuongHieu, :maLoai, :soLuong, :hinhAnh, :moTa)";
$statement = $dbh->prepare($query);
$donGiaMua = $_POST['DONGIAMUA'][$index] ?? 0; // Nếu không có giá trị trong $_POST, gán mặc định là 0
$soLuong = $_POST['SOLUONG'][$index] ?? 0;
// Bind các tham số vào câu lệnh
$statement->bindParam(':maSanPham', $maSanPham);
$statement->bindParam(':tenSanPham', $tenSanPham);
$statement->bindParam(':donGiaMua', $donGiaMua); // Thêm bind cho donGiaMua
$statement->bindParam(':donGiaBan', $donGiaBan);
$statement->bindParam(':maThuongHieu', $maThuongHieu);
$statement->bindParam(':maLoai', $maLoai);
$statement->bindParam(':soLuong', $soLuong); // Thêm bind cho soLuong
$statement->bindParam(':hinhAnh', $imageName); // Lưu đường dẫn ảnh
$statement->bindParam(':moTa', $moTa);

    // Thực thi câu lệnh SQL
    if ($statement->execute()) {
        echo "Sản phẩm $tenSanPham đã được thêm thành công!<br>";
    } else {
        echo "Có lỗi khi thêm sản phẩm $tenSanPham!<br>";
    }
}

// Xóa session sau khi đã lưu xong
unset($_SESSION['uploaded_images']);
unset($_SESSION['categories']);

// Chuyển hướng với URL đầy đủ
echo "<script>window.location.href = 'http://localhost/website/admin/pages/product_index.php';</script>";

?>
