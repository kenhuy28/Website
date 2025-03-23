<?php
include '../templates/header.php';
require_once('../includes/check_giam_gia.php');
$product_id = $_GET['maSanPham'];
$query = "SELECT maSanPham, tenSanPham, donGiaBan, maLoai, soLuong, hinhAnh, moTa, tenThuongHieu FROM san_pham JOIN thuong_hieu ON san_pham.maThuongHieu = thuong_hieu.maThuongHieu WHERE san_pham.maSanPham= :product_id";
$stmt = $dbh->prepare($query);
$stmt->execute([':product_id' => $product_id]);
$sanPham = $stmt->fetch(PDO::FETCH_OBJ);

// Truy vấn thông số kỹ thuật cho sản phẩm hiện tại
$specsQuery = "SELECT loaiThongSo, tenThongSo, giaTriThongSo FROM thong_so_ky_thuat WHERE maSanPham = :product_id";
$specsStmt = $dbh->prepare($specsQuery);
$specsStmt->execute([':product_id' => $product_id]);
$thongSoKyThuat = $specsStmt->fetchAll(PDO::FETCH_OBJ);

// Lấy sản phẩm cùng loại
$maLoai = $sanPham->maLoai; // Lấy mã loại của sản phẩm hiện tại
$relatedProductsQuery = "SELECT maSanPham, tenSanPham, donGiaBan, hinhAnh FROM san_pham WHERE maLoai = :maLoai AND maSanPham != :product_id LIMIT 4"; // Lấy 4 sản phẩm liên quan
$relatedStmt = $dbh->prepare($relatedProductsQuery);
$relatedStmt->execute([':maLoai' => $maLoai, ':product_id' => $product_id]);
$relatedProducts = $relatedStmt->fetchAll(PDO::FETCH_OBJ);

// Tính trung bình số sao đánh giá
$averageRatingQuery = "SELECT AVG(soSao) AS trungBinhSao FROM binh_luan WHERE maSanPham = :product_id";
$averageStmt = $dbh->prepare($averageRatingQuery);
$averageStmt->execute([':product_id' => $product_id]);
$averageRating = $averageStmt->fetch(PDO::FETCH_OBJ)->trungBinhSao;
$averageRating = round($averageRating, 1);

$sql = "SELECT * FROM giam_gia";
$stmt = $dbh->query($sql);
$giamGia = $stmt->fetchAll(PDO::FETCH_OBJ);
if (empty($_SESSION["taiKhoan"])) {
    require_once('../includes/login_required.php');
} else {
    require_once('../includes/ajax_add_product.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment']) && isset($_POST['soSao'])) {
    $comment = $_POST['comment'];
    $soSao = $_POST['soSao'];
    $maKhachHang = isset($_SESSION['taiKhoan']) ? $_SESSION['taiKhoan'] : '';

    // Kiểm tra giá trị $maKhachHang có phải là chuỗi không
    if (is_array($maKhachHang)) {
        $maKhachHang = reset($maKhachHang); // Lấy giá trị đầu tiên nếu là mảng
    }

    if (empty($maKhachHang)) {
        echo "Vui lòng đăng nhập để bình luận.";
        exit;
    }

    // Kiểm tra xem maKhachHang có tồn tại trong bảng khach_hang không
    $checkUserQuery = "SELECT COUNT(*) FROM khach_hang WHERE maKhachHang = :maKhachHang";
    $checkStmt = $dbh->prepare($checkUserQuery);
    $checkStmt->execute([':maKhachHang' => $maKhachHang]);
    $userExists = $checkStmt->fetchColumn();

    if ($userExists) {
        if (empty($comment)) {
            echo "Bình luận không được để trống.";
        } elseif (empty($soSao)) {
            echo "Vui lòng chọn số sao để đánh giá.";
        } else {
            try {
                $query = "INSERT INTO binh_luan (maSanPham, maKhachHang, noiDung, soSao, ngayGio) VALUES (:maSanPham, :maKhachHang, :noiDung, :soSao, NOW())";
                $stmt = $dbh->prepare($query);
                $stmt->execute([
                    ':maSanPham' => $product_id,
                    ':maKhachHang' => $maKhachHang,
                    ':noiDung' => $comment,
                    ':soSao' => $soSao
                ]);
                
                // Cập nhật lại trung bình số sao sau khi thêm bình luận mới
                $averageStmt->execute([':product_id' => $product_id]);
                $averageRating = $averageStmt->fetch(PDO::FETCH_OBJ)->trungBinhSao;
                $averageRating = round($averageRating, 1);
                
              
            } catch (PDOException $e) {
                echo "Lỗi: " . $e->getMessage();
            }
        }
    } else {
        echo "Người dùng không hợp lệ.";
    }
    
}

// Tìm bình luận
$commentQuery = "SELECT * FROM binh_luan JOIN khach_hang ON binh_luan.maKhachHang = khach_hang.maKhachHang WHERE binh_luan.maSanPham = :product_id ORDER BY binh_luan.ngayGio DESC";
$commentStmt = $dbh->prepare($commentQuery);
$commentStmt->execute([':product_id' => $product_id]);
$comments = $commentStmt->fetchAll(PDO::FETCH_OBJ);

?>

<div class="chiTietSanPham">
    <?php
    if ($sanPham->soLuong != 0) {
        $button = '<button name="submit" style="font-size:20px; color:red; font-weight:bold;" class="button_add_admin" productid="' . $sanPham->maSanPham . '"  onclick="addToCart(this)">Thêm vào giỏ hàng</button>';
    } else {
        $button = '<button name="submit" style="font-size:20px; color:red; font-weight:bold;" value="HẾT HÀNG" disabled>HẾT HÀNG</button>';
    }
    
    $dongiahienthi = "";
    if (giamGia($sanPham->maSanPham, $giamGia, $sanPham->donGiaBan) != null) {
        $dongiahienthi = "<div class='product_price' style='display: flex'>
            <h5 style='text-decoration: line-through; width: 70px'>" . number_format($sanPham->donGiaBan) . "đ   </h5>     
            <h5 style='color: red;'>   " . number_format(giamGia($sanPham->maSanPham, $giamGia, $sanPham->donGiaBan)) . "đ</h5>
        </div>";
    } else {
        $dongiahienthi = "<div class='product_price'>
            <h5>" . number_format($sanPham->donGiaBan) . "đ</h5>
        </div>";
    }
    echo '
        <div class="chiTietSanPham_left">
            <img src="../assets/img/sanpham/' . $sanPham->hinhAnh . ' " style="height:500px; width:500px;">
            <div class="chiTietSanPham_giamgia">Giảm giá</div>
        </div>
        <div class="chiTietSanPham_right">
            <h4>' . htmlspecialchars($sanPham->tenSanPham) . '</h4>
            <div class="average_rating">
                <span>Đánh giá : ' . ($averageRating ? $averageRating : 'Chưa có đánh giá') . '</span>
                ';

    if ($averageRating) {
        echo '<div class="star_rating">';
        $fullStars = floor($averageRating);
        $halfStar = ($averageRating - $fullStars) >= 0.5 ? true : false;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

        for ($i = 0; $i < $fullStars; $i++) {
            echo '<i class="fas fa-star" style="color: gold;"></i>';
        }
        if ($halfStar) {
            echo '<i class="fas fa-star-half-alt" style="color: gold;"></i>';
        }
        for ($i = 0; $i < $emptyStars; $i++) {
            echo '<i class="far fa-star" style="color: gold;"></i>';
        }
        echo '</div>';
    }
    echo '
     <button 
                name="compare" 
                style="font-size:20px; color:red; font-weight:bold;" 
                onclick="addToCompare(this)" 
                data-id="' . htmlspecialchars($sanPham->maSanPham, ENT_QUOTES, 'UTF-8') . '" 
                data-name="' . htmlspecialchars($sanPham->tenSanPham, ENT_QUOTES, 'UTF-8') . '" 
                data-image="' . htmlspecialchars('../assets/img/sanpham/' . $sanPham->hinhAnh, ENT_QUOTES, 'UTF-8') . '"
            >
                So sánh +
            </button>
            </div>
            <div>
                <p>Tên thương hiệu: ' . htmlspecialchars($sanPham->tenThuongHieu) . '</p>
            </div>
            <div>

                <h1 style="color:red;">
                ' . $dongiahienthi . '
                </h1>
            </div>
            <div>
                <h3>Số lượng còn: ' . htmlspecialchars($sanPham->soLuong) . '</h3>
            </div>
            
            <div>
            ' . $button . '
            <!-- Nút So sánh với data-* attributes -->
            </div>
            <div class="chiTietSanPham_right_mota">
                <span>Mô tả: </span>
                ' . htmlspecialchars($sanPham->moTa) . '
            </div>
        </div>';
    ?>
</div>
<!-- Hiển thị sản phẩm liên quan dưới chi tiết sản phẩm -->
<div class="related-products">
    <h1>Sản phẩm liên quan</h1>
    <div class="related-products-container">
        <?php foreach ($relatedProducts as $relatedProduct): ?>
            <div class="related-product" onclick="window.location.href='product_detail_page.php?maSanPham=<?php echo $relatedProduct->maSanPham; ?>'">
                <img src="../assets/img/sanpham/<?php echo $relatedProduct->hinhAnh; ?>" alt="<?php echo htmlspecialchars($relatedProduct->tenSanPham); ?>">
                <h5><?php echo htmlspecialchars($relatedProduct->tenSanPham); ?></h5>
                <p><?php echo number_format($relatedProduct->donGiaBan) . 'đ'; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Khung hiển thị sản phẩm so sánh -->
<div id="compare-container">
    <button id="toggle-compare" style="position: absolute; top: 10px; right: 10px; z-index: 1001;" onclick="toggleCompare()">Thu gọn</button>
    <div class="compare-items">
        <div class="compare-item">
            <span class="remove-button" onclick="removeFromCompare(0)">X</span>
            <img id="product-1-image" src="" alt="" class="compare-image" />
            <div id="product-1-name"></div>
        </div>
        <div class="compare-item">
            <span class="remove-button" onclick="removeFromCompare(1)">X</span>
            <img id="product-2-image" src="" alt="" class="compare-image" />
            <div id="product-2-name"></div>
        </div>
        <div class="compare-item">
            <span class="remove-button" onclick="removeFromCompare(2)">X</span>
            <img id="product-3-image" src="" alt="" class="compare-image" />
            <div id="product-3-name"></div>
        </div>
        <div class="compare-item" style="flex: 1; border: 1px solid #ccc; padding: 10px; border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <button onclick="goToCompare()" class="compare-button">So sánh ngay</button>
        </div>
    </div>
</div>

<div id="small-compare-container" style="display: none;" onclick="showFullCompare()">
    So sánh
</div>

<script>
    // Lấy danh sách sản phẩm từ Local Storage hoặc khởi tạo mảng rỗng
    let compareProducts = JSON.parse(localStorage.getItem('compareProducts')) || [];

    function addToCompare(button) {
        // Lấy thông tin sản phẩm từ các thuộc tính data-*
        const productId = button.getAttribute('data-id');
        const productName = button.getAttribute('data-name');
        const productImage = button.getAttribute('data-image');

        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách so sánh chưa
        if (compareProducts.find(product => product.id === productId)) {
            alert("Sản phẩm này đã được thêm vào danh sách so sánh.");
            return;
        }

        if (compareProducts.length < 3) { // Kiểm tra xem có tối đa 3 sản phẩm không
            const product = {
                id: productId,
                name: productName,
                image: productImage
            };
            
            compareProducts.push(product); // Thêm sản phẩm vào danh sách so sánh
            updateCompareList(); // Cập nhật danh sách so sánh
            localStorage.setItem('compareProducts', JSON.stringify(compareProducts)); // Lưu danh sách vào Local Storage
        } else {
            alert("Bạn chỉ có thể so sánh tối đa 3 sản phẩm.");
        }
    }

    function updateCompareList() {
        for (let i = 0; i < 3; i++) {
            if (i < compareProducts.length) {
                document.getElementById('product-' + (i + 1) + '-image').src = compareProducts[i].image;
                document.getElementById('product-' + (i + 1) + '-name').textContent = compareProducts[i].name;
                document.getElementById('product-' + (i + 1) + '-image').alt = compareProducts[i].name;
            } else {
                document.getElementById('product-' + (i + 1) + '-image').src = '';
                document.getElementById('product-' + (i + 1) + '-name').textContent = '';
            }
        }

        // Hiển thị khung so sánh nếu có sản phẩm
        document.getElementById('compare-container').style.display = compareProducts.length > 0 ? 'flex' : 'none';
    }

    // Hàm xóa sản phẩm khỏi danh sách so sánh
    function removeFromCompare(index) {
        compareProducts.splice(index, 1); // Xóa sản phẩm tại vị trí index
        updateCompareList(); // Cập nhật lại danh sách
        localStorage.setItem('compareProducts', JSON.stringify(compareProducts)); // Cập nhật Local Storage
    }

    function goToCompare() {
        if (compareProducts.length === 0) {
            alert("Không có sản phẩm nào để so sánh.");
            return;
        }
        // Lấy các ID sản phẩm từ danh sách so sánh
        const ids = compareProducts.map(product => product.id).join(',');

        // Chuyển hướng đến trang compare.php với các ID sản phẩm làm tham số
        window.location.href = 'compare.php?ids=' + encodeURIComponent(ids);
    }

    // Tải lại danh sách so sánh khi trang được tải lại
    window.onload = function() {
        compareProducts = JSON.parse(localStorage.getItem('compareProducts')) || [];
        updateCompareList();
    };
    
    let isCollapsed = false; // Biến để theo dõi trạng thái

    function toggleCompare() {
    const compareContainer = document.getElementById('compare-container');
    const toggleButton = document.getElementById('toggle-compare');
    const smallCompareContainer = document.getElementById('small-compare-container');

    if (isCollapsed) {
        compareContainer.style.display = 'flex'; // Hiện khung so sánh
        smallCompareContainer.style.display = 'none'; // Ẩn ô nhỏ
        toggleButton.textContent = 'So sánh'; // Đổi chữ trên nút
    } else {
        compareContainer.style.display = 'none'; // Ẩn khung so sánh
        smallCompareContainer.style.display = 'block'; // Hiện ô nhỏ
        toggleButton.textContent = 'Thu gọn'; // Đổi chữ trên nút
    }

    isCollapsed = !isCollapsed; // Đảo trạng thái
}

function showFullCompare() {
    const smallCompareContainer = document.getElementById('small-compare-container');
    smallCompareContainer.style.display = 'none'; // Ẩn ô nhỏ
    document.getElementById('compare-container').style.display = 'flex'; // Hiện khung so sánh
    isCollapsed = false; // Đặt lại trạng thái
}
</script>

<div class="product-details">
    <div class="chiTietSanPham_comments" style="flex: 7;">
        <h3>Ý kiến và đánh giá</h3>
        <div class="comment_form">
            <form method="post" action="">
                <textarea name="comment" placeholder="Viết bình luận của bạn ở đây..." required></textarea>
                
                <div class="star-rating">
                    <span>Đánh giá:</span>
                    <div class="stars">
                        <input type="radio" id="star5" name="soSao" value="5" />
                        <label for="star5" title="5 sao">&#9733;</label>
                        
                        <input type="radio" id="star4" name="soSao" value="4" />
                        <label for="star4" title="4 sao">&#9733;</label>
                        
                        <input type="radio" id="star3" name="soSao" value="3" />
                        <label for="star3" title="3 sao">&#9733;</label>
                        
                        <input type="radio" id="star2" name="soSao" value="2" />
                        <label for="star2" title="2 sao">&#9733;</label>
                        
                        <input type="radio" id="star1" name="soSao" value="1" />
                        <label for="star1" title="1 sao">&#9733;</label>
                    </div>
                </div>
                
                <button type="submit">Gửi bình luận</button>
            </form>
        </div>
        
        <div class="comments_list">
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <div class="user_name">
                        <i class="fas fa-user"></i>
                        <?php echo htmlspecialchars($comment->hoKhachHang . ' ' . $comment->tenKhachHang); ?>
                    </div>
                    <div class="comment_rating">
                        <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $comment->soSao) {
                                    echo '<i class="fas fa-star" style="color: gold;"></i>';
                                } else {
                                    echo '<i class="far fa-star" style="color: gold;"></i>';
                                }
                            }
                        ?>
                    </div>
                    <div class="comment_text"><?php echo htmlspecialchars($comment->noiDung); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="specifications" style="flex: 3;">
    <h3>Thông số kỹ thuật</h3>
    <ul>
        <?php 
        $count = 0; // Biến đếm số thông số đã hiển thị
        foreach ($thongSoKyThuat as $thongSo): 
            if ($count < 10): // Chỉ hiển thị tối đa 10 thông số
        ?>
            <li><?php echo htmlspecialchars($thongSo->tenThongSo) . ': ' . htmlspecialchars($thongSo->giaTriThongSo); ?></li>
        <?php 
                $count++; 
            endif; 
        endforeach; 
        ?>
    </ul>
    <button id="view-details" onclick="toggleDetails()">Xem cấu hình chi tiết</button>
</div>

<!-- Bảng thông số chi tiết -->
<div id="details-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>THÔNG SỐ KỸ THUẬT</h3>
            <span class="close">&times;</span> <!-- Nút đóng ở góc trên -->
        </div>
        <div class="modal-body">
            <?php 
            // Nhóm thông số theo loại
            $thongSoTheoLoai = [];
            foreach ($thongSoKyThuat as $thongSo) {
                // Kiểm tra xem thuộc tính loaiThongSo có tồn tại không
                if (isset($thongSo->loaiThongSo)) {
                    $thongSoTheoLoai[$thongSo->loaiThongSo][] = $thongSo;
                }
            }
            ?>
            
            <?php foreach ($thongSoTheoLoai as $loai => $thongSoList): ?>
                <div class="thong-so-loai">
                    <h4><?php echo htmlspecialchars($loai); ?></h4>
                    <ul>
                        <?php foreach ($thongSoList as $thongSo): ?>
                            <li><?php echo htmlspecialchars($thongSo->tenThongSo) . ': ' . htmlspecialchars($thongSo->giaTriThongSo); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="close-modal">Đóng</button> <!-- Nút đóng ở cuối -->
    </div>
</div>

<script>
function toggleDetails() {
    const detailsDiv = document.getElementById('details');
    if (detailsDiv.style.display === 'none') {
        detailsDiv.style.display = 'block';
    } else {
        detailsDiv.style.display = 'none';
    }
}
// Lấy phần tử modal
var modal = document.getElementById("details-modal");

// Lấy nút để mở modal
var btn = document.getElementById("view-details");

// Lấy nút đóng
var span = document.getElementsByClassName("close")[0];

// Khi người dùng nhấn nút, mở modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Khi người dùng nhấn nút đóng, ẩn modal
span.onclick = function() {
    modal.style.display = "none";
}

// Khi người dùng nhấn bất kỳ đâu bên ngoài modal, ẩn modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
// Lấy modal
var modal = document.getElementById("details-modal");
var closeButton = document.querySelector(".close");
var closeModalButton = document.querySelector(".close-modal");

// Mở modal
function openModal() {
    modal.style.display = "block";
}

// Đóng modal
function closeModal() {
    modal.style.display = "none";
}

// Thêm sự kiện cho nút đóng
closeButton.onclick = closeModal;
closeModalButton.onclick = closeModal;

// Đóng modal khi nhấp ra ngoài modal
window.onclick = function(event) {
    if (event.target === modal) {
        closeModal();
    }
}
</script>
</div>
<style>
/* chi tiết sản  phâm */
.chiTietSanPham {
    display: flex;
    min-height: 600px;
}
.comment .user_name i {
    margin-right: 20px; /* Khoảng cách giữa icon và tên người dùng */
}
.comment .comment_rating i {
    margin-right: 5px;
    color: gold;
}
.comment .comment_text {
    font-size: 16px;
    margin: 10;
    padding-left: 40px; /* Thụt vào phần bình luận */
}

</style>
<?php include '../templates/footer.php' ?>