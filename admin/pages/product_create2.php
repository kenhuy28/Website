<?php
session_start();
$_SESSION['uploaded_images'] = $uploadedImages; // Mảng chứa dữ liệu ảnh
$_SESSION['categories'] = ['banphim', 'camera', 'chuot', 'dienthoai', 'dongho', 'laptop', 'mayin'];
var_dump($_SESSION['uploaded_images']);
include '../templates/nav_admin1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = "assets/img/sanpham/";
    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    // Mảng lưu trữ ảnh và phân loại
    $uploadedImages = [];
    $categories = ['banphim', 'camera', 'chuot', 'dienthoai', 'dongho', 'laptop', 'mayin'];

    // Kiểm tra xem $_FILES['image'] có phải là mảng hay không
    if (is_array($_FILES['image']['tmp_name'])) {
        // Xử lý trường hợp nhiều ảnh
        foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['image']['name'][$key]);
            $sanitizedFileName = $fileName;
            $uploadFile = $uploadDir . $sanitizedFileName;
            // Xử lý upload file
            if (move_uploaded_file($tmp_name, $uploadFile)) {
                // Gọi API Flask để phân loại sản phẩm
                $pythonAPI = "http://127.0.0.1:5000/predict";  // Đảm bảo rằng Flask server đang chạy
                $fileData = curl_file_create($uploadFile);  // Tạo file từ đường dẫn ảnh

                // Cấu hình cURL để gửi yêu cầu POST tới Flask API
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $pythonAPI);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $fileData]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Gửi yêu cầu và nhận phản hồi
                $response = curl_exec($ch);
                curl_close($ch);

                // Xử lý kết quả phân loại
                $responseData = json_decode($response, true);
                $category = $responseData['predicted_class'] ?? 'Không xác định';

                // Lưu ảnh và phân loại vào mảng
                $uploadedImages[] = ['image' => $uploadFile, 'category' => $category];
            }
        }
    } else {
        // Xử lý trường hợp chỉ chọn một ảnh
        $tmp_name = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $sanitizedFileName = $fileName;
        $uploadFile = $uploadDir . $sanitizedFileName;

        // Xử lý upload file
        if (move_uploaded_file($tmp_name, $uploadFile)) {
            // Gọi API Flask để phân loại sản phẩm
            $pythonAPI = "http://127.0.0.1:5000/predict";  // Đảm bảo rằng Flask server đang chạy
            $fileData = curl_file_create($uploadFile);  // Tạo file từ đường dẫn ảnh

            // Cấu hình cURL để gửi yêu cầu POST tới Flask API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $pythonAPI);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $fileData]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Gửi yêu cầu và nhận phản hồi
            $response = curl_exec($ch);
            curl_close($ch);

            // Xử lý kết quả phân loại
            $responseData = json_decode($response, true);
            $category = $responseData['predicted_class'] ?? 'Không xác định';

            // Lưu ảnh và phân loại vào mảng
            $uploadedImages[] = ['image' => $uploadFile, 'category' => $category];
        }
    }

    // Kiểm tra nếu session chưa được khởi tạo
if (!isset($_SESSION['uploaded_images'])) {
    $_SESSION['uploaded_images'] = [];
}
// Lưu vào session để truyền qua trang khác
$_SESSION['uploaded_images'] = $uploadedImages;
$_SESSION['categories'] = $categories; // Lưu mảng các loại sản phẩm
$mapLoai = [
    'banphim' => 'LSP005',
    'camera' => 'LSP007',
    'chuot' => 'LSP006',
    'dienthoai' => 'LSP001',
    'dongho' => 'LSP003',
    'laptop' => 'LSP002',
    'mayin' => 'LSP004'
];

// Lưu ảnh và loại sản phẩm được tải lên
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadedFileName = $_FILES['image']['name'];
    $uploadedFilePath = '../assets/img/sanpham/' . $uploadedFileName;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFilePath);
    // Lưu mã loại vào session
    $_SESSION['MALOAI'] = $maloai;
    
    // Lưu thông tin vào session
    $_SESSION['uploaded_images'][] = [
        'image' => $uploadedFilePath,
        'loai' => $_POST['MALOAI'] ?? null // Loại sản phẩm từ form
        
    ];
}

      // Gửi dữ liệu ảnh sang JavaScript
      echo '<script>
      const products = ' . json_encode($uploadedImages) . ';
    </script>';

    // Nếu có phân loại, lấy mã loại tương ứng
if (array_key_exists($category, $mapLoai)) {
    $maloai = $mapLoai[$category]; // Lấy mã loại từ mảng ánh xạ
} else {
    $maloai = 'default_value'; // Nếu không tìm thấy, sử dụng mã loại mặc định
}
$_SESSION['MALOAI'] = $maloai;


}
?>

<div class="pr2">
    <form method="POST" enctype="multipart/form-data">
        <input type="file" id="imageInput" name="image[]" accept="image/*" multiple required>
        <button type="submit">Tiến hành thêm sản phẩm</button>
    </form>
</div>
<div class="pr2" id="productContainer" style="display:none;">
    <div id="imageWrapper"></div>
    <div id="productCategory">
    <div class="form_field">
        <label for="category_${index}" class="name_form_field">Phân loại sản phẩm:</label>
        <select required class="textfile" name="category[]" id="category_${index}" disabled>
            <option disabled value="">Chọn phân loại</option>
            ${categoryOptions}
        </select>
        <span class="error_message"></span>
    </div>
    <button type="button" id="editCategoryButton_${index}" class="edit-category-button">Sửa</button>
    <button type="button" id="saveCategoryButton_${index}" class="save-category-button" style="display: none;">Lưu</button>
    </div>
    <div class="navigation-buttons">
    <button id="prevButton" disabled>Prev</button>
    <form method="POST" action="create_multiple_products.php" style="margin: 0;">
   
        <button type="submit">Xác nhận tất cả</button>
    </form>
    <button id="nextButton" disabled>Next</button>
</div>


<script>
let currentIndex = 0;
// Khởi tạo dữ liệu sản phẩm từ PHP
const productContainer = document.getElementById('productContainer');
const imageWrapper = document.getElementById('imageWrapper');
const productCategory = document.getElementById('productCategory');
const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');

// Tạo một đối tượng ánh xạ từ tên không dấu sang có dấu
const categoryMapping = {
    'banphim': 'Bàn phím',
    'camera': 'Camera',
    'chuot': 'Chuột',
    'dienthoai': 'Điện thoại',
    'dongho': 'Đồng hồ',
    'laptop': 'Laptop',
    'mayin': 'Máy in'
};

// Hiển thị sản phẩm hiện tại
function displayProduct(index) {
    const product = products[index];
    if (product) {
        // Hiển thị ảnh
        imageWrapper.innerHTML = `<img src="${product.image}" alt="Ảnh sản phẩm" style="max-width: 200px; height: auto;">`;

        // Chuyển tên loại sản phẩm từ không dấu sang có dấu
        const categoryOptions = ['banphim', 'camera', 'chuot', 'dienthoai', 'dongho', 'laptop', 'mayin']
            .map(cat => `<option value="${cat}" ${cat === product.category ? 'selected' : ''}>${categoryMapping[cat] || cat}</option>`)
            .join('');

        const categorySelectHTML = `
            <div class="form_field">
                <label for="category_${index}" class="name_form_field">Loại sản phẩm:</label>
                <select required class="textfile" name="category[]" id="category_${index}" disabled>
                    <option disabled value="">Chọn phân loại</option>
                    ${categoryOptions}
                </select>
                <span class="error_message"></span>
                <button type="button" id="editCategoryButton_${index}" class="edit-category-button">Sửa</button>
                <button type="button" id="saveCategoryButton_${index}" class="save-category-button" style="display: none;">Lưu</button>
            </div>`;
        productCategory.innerHTML = categorySelectHTML;

        // Sự kiện nút "Sửa"
        const editButton = document.getElementById(`editCategoryButton_${index}`);
        editButton.addEventListener('click', () => {
            const select = document.getElementById(`category_${index}`);
            select.disabled = false; // Mở dropdown để chọn lại phân loại
            editButton.style.display = 'none'; // Ẩn nút "Sửa"
            const saveButton = document.getElementById(`saveCategoryButton_${index}`);
            saveButton.style.display = 'inline-block'; // Hiển thị nút "Lưu"
        });

        // Sự kiện nút "Lưu" (Cập nhật session)
        const saveButton = document.getElementById(`saveCategoryButton_${index}`);
        // Sự kiện nút "Lưu" (Cập nhật session)
        saveButton.addEventListener('click', () => {
    const select = document.getElementById(`category_${index}`);
    const selectedCategory = select.value; // Lấy giá trị loại sản phẩm đã chọn từ dropdown

    // Cập nhật lại session với loại sản phẩm mới
    fetch('../includes/update_session.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            productIndex: index, // Chỉ số sản phẩm cần cập nhật
            newCategory: selectedCategory // Loại sản phẩm mới
        })
    })
    .then(response => response.json())
    .then(data => {
    if (data.success) {
        alert('Cập nhật loại sản phẩm thành công!');
        
    } else {
        alert('Có lỗi xảy ra khi cập nhật!');
    }
});

    // Ẩn nút "Lưu" và đóng dropdown
    saveButton.style.display = 'none';
    const editButton = document.getElementById(`editCategoryButton_${index}`);
    editButton.style.display = 'inline-block'; // Hiển thị lại nút "Sửa"
    select.disabled = true; // Tắt dropdown để không thể chọn lại
});
        // Cập nhật trạng thái nút
        prevButton.disabled = index === 0;
        nextButton.disabled = index === products.length - 1;
    }
}

// Sự kiện nút Prev
prevButton.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        displayProduct(currentIndex);
    }
});

// Sự kiện nút Next
nextButton.addEventListener('click', () => {
    if (currentIndex < products.length - 1) {
        currentIndex++;
        displayProduct(currentIndex);
    }
});

// Khởi tạo khi có sản phẩm
if (products.length > 0) {
    productContainer.style.display = 'block';
    displayProduct(currentIndex);
}
</script>


<style>
.navigation-buttons {
    margin-top: 20px;  /* Tạo khoảng cách với phần trên */
    display: flex;
    justify-content: center; /* Căn giữa các nút theo chiều ngang */
    align-items: center; /* Căn giữa theo chiều dọc */
    gap: 20px; /* Khoảng cách giữa các nút */
    width: 100%; /* Đảm bảo chiếm hết chiều rộng */
}

.pr2 {
    width: 100%; /* Điều chỉnh độ rộng của div */
    max-width: 1200px; /* Đảm bảo chiều rộng không vượt quá 600px */
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px; /* Bo góc cho div */
    position: relative;
    overflow: hidden; /* Đảm bảo phần tử không tràn ra ngoài */
}

.image-container {
            display: flex;
            flex-direction: column;
            align-items: center; /* Căn giữa theo chiều ngang */
            justify-content: center; /* Căn giữa theo chiều dọc */
            height: 200px; /* Điều chỉnh chiều cao nếu cần */
        }
        /* Căn giữa #imageWrapper */
        #imageWrapper {
            width: 100%; 
            height: 150px; /* Chiều cao của wrapper */
            margin: 20px 0; /* Khoảng cách trên và dưới */
           
            display: flex;
            justify-content: center; /* Căn giữa nội dung bên trong */
            align-items: center; /* Căn giữa nội dung theo chiều dọc */
            
        }
#productCategory {
    font-size: 18px;
    color: #333;    
    margin-top:  10px;
    text-align: center;
}    

button {
    margin: 10px;
        padding: 10px;
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;    
    }    
button[disabled] {
    background-color: #ccc;
}
.form_field {
    margin-bottom: 15px;
    display: flex; /* Sử dụng flexbox */
    flex-direction: column; /* Đặt các phần tử theo chiều dọc */
    align-items: center; /* Căn giữa các phần tử theo chiều ngang */
}

.name_form_field {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px; /* Khoảng cách giữa label và phần tử select */
    padding-top:14px;
}

.textfile {
    width: 80%; /* Chiều rộng của select */
    padding: 6px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin: 0;
    margin-bottom: 10px; /* Khoảng cách giữa select và button */
}

.edit-category-button {
    background-color: #f0ad4e;
    color: #fff;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    font-size: 14px;
}

.edit-category-button:hover {
    background-color: #ec971f;
}
.name_form_field {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px; /* Khoảng cách giữa label và phần tử select */
    padding-top:14px;
}

.textfile {
    padding: 6px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 20%;
}
.error_message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}
.navigation-buttons {
    margin-top: 10px;
    display: flex;
    justify-content: center; /* Căn giữa các nút theo chiều ngang */
    align-items: center; /* Căn giữa theo chiều dọc */
    gap: 20px; /* Khoảng cách đều giữa các nút */
}

button {
    padding: 10px 15px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[disabled] {
    background-color: #ccc;
    cursor: not-allowed;
}

button:hover:not([disabled]) {
    background-color: #0056b3;
}

form {
    margin: 0;
}

button:hover {
    background-color: #0056b3;
}

img {
    max-width: 200px;
    height: auto;
    margin-bottom: 30px;
}
select {
    display: block;
    width: 100%; /* Hoặc một kích thước cụ thể, nếu muốn */
    text-align: center; /* Căn giữa chữ trong select */
    margin: 0 auto; /* Để căn giữa select nếu muốn */
}

option {
    text-align: center; /* Căn giữa chữ trong option */
    padding: 5px; /* Điều chỉnh padding để đảm bảo chữ không bị cắt */
}
</style>
