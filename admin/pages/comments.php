<?php include '../templates/nav_admin1.php';
include '../includes/check_permisson.php';
check($nv->maLoai, 'CMT');
?>
<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="add_admin">
            <a href="comment_create.php"> <!-- Bạn có thể thay đổi trang thêm bình luận nếu cần -->
                <i class="fa-solid fa-comment-plus"></i>
                <div class="add_title">
                BÌNH LUẬN
                </div>
            </a>
        </div>
    </div>
    <table class="table_dsadmin">
        <thead>
            <tr style="font-size: 15px;">
                <th style="width: 10%;">Mã Sản Phẩm</th>
                <th style="width: 25%;">Tên Sản Phẩm</th>
                <th style="width: 25%;">Tên Khách Hàng</th>
                <th style="width: 25%;">Nội Dung</th>
                <th style="width: 15%;">Ngày Giờ</th>
            </tr>
        </thead>
        <tbody>
            <!-- Hiển thị danh sách bình luận -->
            <?php include '../includes/show_comment_table.php' ?>
        </tbody>
    </table>
    <style>
        p {
            font-size: 15px;
            padding: 5px;
        }
    </style>
    <?php include '../includes/pagination.php' ?>
</div>
<?php include '../templates/nav_admin2.php' ?>
