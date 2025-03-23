<?php
session_start();
var_dump($_SESSION['uploaded_images']);
include '../templates/nav_admin1.php';
include '../includes/get_new_product_id2.php';

// Lưu các session được gửi từ file product_create2.php
if (isset($_POST['uploaded_images']) && is_array($_POST['uploaded_images'])) {
    $_SESSION['uploaded_images'] = $_POST['uploaded_images'];
}

if (isset($_POST['categories']) && is_array($_POST['categories'])) {
    $_SESSION['categories'] = $_POST['categories'];
}

// Kiểm tra và lấy dữ liệu từ session
if (isset($_SESSION['uploaded_images']) && is_array($_SESSION['uploaded_images'])) {
    $uploadedImages = $_SESSION['uploaded_images'];
} else {
    $uploadedImages = []; // Khởi tạo mảng rỗng nếu không có dữ liệu
    echo "Không có hình ảnh tải lên!";
    exit;
}

if (isset($_SESSION['categories']) && is_array($_SESSION['categories'])) {
    $categories = $_SESSION['categories'];
} else {
    $categories = []; // Khởi tạo mảng rỗng nếu không có dữ liệu
    echo "Không có loại sản phẩm nào!";
    exit;
}
// Kiểm tra và lấy dữ liệu từ session
if (isset($_SESSION['uploaded_images']) && is_array($_SESSION['uploaded_images'])) {
    $uploadedImages = $_SESSION['uploaded_images'];
} else {
    $uploadedImages = []; // Khởi tạo mảng rỗng nếu không có dữ liệu
    echo "Không có hình ảnh tải lên!";
    exit;
}

if (isset($_SESSION['categories']) && is_array($_SESSION['categories'])) {
    $categories = $_SESSION['categories'];
} else {
    $categories = []; // Khởi tạo mảng rỗng nếu không có dữ liệu
    echo "Không có loại sản phẩm nào!";
    exit;
}

$categoryMapping = [
    'banphim' => 'Bàn phím',
    'camera' => 'Camera',
    'chuot' => 'Chuột',
    'dienthoai' => 'Điện thoại',
    'dongho' => 'Đồng hồ',
    'laptop' => 'Laptop',
    'mayin' => 'Máy in'
];



// Lấy số lượng sản phẩm cần thêm
$quantity = count($uploadedImages); // Số lượng ảnh được phân loại

// Gọi hàm để lấy danh sách mã sản phẩm
$newProductIds = getNewProductIds($dbh, $quantity);

?>


<style>
    input, select, textarea {
        font-size: 16px;
    }

    label {
        font-size: 20px;
    }
</style>

<div class="body" style="margin-top: 15px">
    <div class="create_admin">
        <h1 class="Title_Admin_create_form">Thêm nhiều sản phẩm</h1>
        <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>

        <!-- Form xác nhận sản phẩm đã tải lên và phân loại -->
        <form method="POST" action="../includes/save_multiple_products.php" enctype="multipart/form-data">
            <div id="products">
            <?php foreach ($uploadedImages as $index => $product): ?>
    <div class="product-item" id="product_<?php echo $index; ?>" style="display: none;">
        <!-- Hiển thị ảnh từ session -->
        <div class="image-container">
            <img src="<?php echo $product['image']; ?>" id="img_product_<?php echo $index; ?>" name="image[]" alt="Ảnh sản phẩm" style="max-width: 200px; height: auto;">
        </div>

        <!-- Mã sản phẩm -->
        <div class="form_field">
            <label for="MASP_<?php echo $index; ?>" class="name_form_field">Mã sản phẩm:</label>
            <input type="text" class="textfile" readonly value="<?php echo $newProductIds[$index]; ?>" name="MASP[]">
        </div>

        <!-- Tên sản phẩm -->
        <div class="form_field">
            <label for="TENSP_<?php echo $index; ?>" class="name_form_field">Tên sản phẩm:</label>
            <input required type="text" class="textfile" name="TENSP[]">
        </div>

        <!-- Đơn giá bán -->
        <div class="form_field">
            <label for="DONGIABAN_<?php echo $index; ?>" class="name_form_field">Đơn giá bán:</label>
            <input required type="number" class="textfile" name="DONGIABAN[]">
        </div>

        <!-- Thương hiệu -->
        <div class="form_field">
            <label for="thuonghieu_<?php echo $index; ?>" class="name_form_field">Thương hiệu:</label>
            <select required class="textfile" name="MATH[]" id="thuonghieu_<?php echo $index; ?>">
                <option disabled selected value="">Chọn thương hiệu</option>
                <?php include '../includes/show_brand_in_option.php' ?>
            </select>
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="form_field">
            <label for="MOTA_<?php echo $index; ?>" class="name_form_field">Mô tả:</label>
            <textarea class="textfile_address" name="MOTA[]"></textarea>
        </div>

        <!-- Phân loại sản phẩm -->
        <div class="form_field">
            <label for="category_<?php echo $index; ?>" class="name_form_field">Loại sản phẩm:</label>
            <select required class="textfile" name="category[]">
                <option disabled value="">Chọn phân loại</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category; ?>" <?php echo $category === $product['category'] ? 'selected' : ''; ?>>
                        <?php echo ucfirst($category); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
<?php endforeach; ?>

            </div>

            <!-- Nút xác nhận -->
            <div class="button">
                <input type="submit" value="Thêm" class="button_add_admin" />
                <a href="product_index.php"><input type="button" value="Quay lại" class="button_add_admin" /></a>
                <div class="navigation-buttons">
                    <button id="prevButton" disabled class="button_add_admin">Prev</button>
                    <button id="nextButton" disabled class="button_add_admin">Next</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let currentIndex = 0; // Chỉ số sản phẩm hiện tại
const products = document.querySelectorAll('.product-item'); // Lấy tất cả sản phẩm
const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');

// Hiển thị sản phẩm hiện tại
function displayProduct(index) {
    // Ẩn tất cả các sản phẩm
    products.forEach((product, i) => {
        product.style.display = 'none'; // Ẩn tất cả
    });

    // Hiển thị sản phẩm hiện tại
    if (products[index]) {
        products[index].style.display = 'block';
    }

    // Cập nhật trạng thái của nút Prev và Next
    prevButton.disabled = index === 0;
    nextButton.disabled = index === products.length - 1;
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
    displayProduct(currentIndex);
}

</script>
<style>
        .textfile_address {
    min-width: 830px;
    margin-bottom: 6px;
    border-radius: 10px;
    border: 1px solid rgb(0,0,0,0.3);
    text-indent: 5px;
    outline: none;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    height: 100px;
}
    .pr2 {
        width: 100%;
        max-width: 1200px;
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }

    .product-item {
        margin-bottom: 30px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .form_field {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .name_form_field {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .textfile {
        width: 80%;
        padding: 6px;
        font-size: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin: 0;
        margin-bottom: 10px;
    }

    .error_message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }
    button {
    padding: 10px 15px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Hiệu ứng chuyển màu nền khi hover */
}

button[disabled] {
    background-color: #007bff; /* Giữ màu nền như bình thường khi disabled */
    cursor: not-allowed; /* Con trỏ chuột thay đổi khi disabled */
}

button:hover {
    background-color: #0056b3; /* Màu nền khi hover */
}

.navigation-buttons {
    display: flex;
    justify-content: center; /* Căn giữa các nút theo chiều ngang */
    align-items: center; /* Căn giữa các nút theo chiều dọc */
    gap: 20px; /* Khoảng cách giữa hai nút */
    margin-top: 20px; /* Khoảng cách phía trên các nút */
}

.button {
    display: flex;
    justify-content: space-between; /* Đảm bảo các nút phân bố đều */
    gap: 20px; /* Khoảng cách giữa các nút */
    margin-top: 20px; /* Khoảng cách phía trên */
    align-items: center; /* Căn giữa các nút theo chiều dọc */
}

.button_add_admin {
    padding: 10px 20px; /* Thêm padding cho nút */
    font-size: 16px; /* Kích thước chữ trong nút */
    background-color: #007bff; /* Màu nền của nút */
    border: none; /* Không có viền */
    border-radius: 5px; /* Bo góc cho nút */
    cursor: pointer; /* Con trỏ chuột sẽ thay đổi khi hover */
    transition: background-color 0.3s ease; /* Hiệu ứng chuyển màu nền khi hover */
    flex: 1; /* Các nút chiếm cùng một không gian */
}

.button_add_admin:hover {
    background-color: #0056b3; /* Màu nền khi hover */
}

.button_add_admin:disabled {
    background-color: #007bff; /* Màu nền giữ nguyên khi nút bị vô hiệu hóa */
    cursor: not-allowed; /* Giữ con trỏ chuột ở trạng thái không được phép */
}

.navigation-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex: 1;
}

.navigation-buttons button {
    flex: 1;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.navigation-buttons button:hover {
    background-color: #0056b3;
}

.navigation-buttons button:disabled {
    background-color: #007bff; /* Giữ màu nền như bình thường khi disabled */
    cursor: not-allowed; /* Giữ con trỏ chuột ở trạng thái không được phép */
}



</style>

<?php include '../templates/nav_admin2.php'; ?>
