<?php include '../templates/nav_admin1.php' ?>
<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="search">
            <a href="#">
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="search_title">
                    Tìm kiếm nhanh
                </div>
            </a>
        </div>
        <div class="add_admin">
            <a href="product_create.php">
                <i class="fa-solid fa-user-plus"></i>
                <div class="add_title">
                    Thêm sản phẩm
                </div>
            </a>
        </div>
    </div>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th style="width: 65px;">Mã Sản Phẩm </th>
                <th style="width: 180px;">Tên Sản Phẩm</th>
                <th style="width: 84px;">Giá mua</th>
                <th style="width: 84px;">Giá bán</th>
                <th style="width: 170px;">Thương hiệu</th>
                <th style="width: 100px;">Loại</th>
                <th style="width: 70px;">Số lượng Tồn</th>
                <th style="width: 250px;">Mô tả</th>
                <th style="width: 70px;">Hình ảnh</th>
                <th style="width: 90px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <!-- hiển thị danh sách sản phẩm -->
            <?php include '../includes/show_product_table.php' ?>

        </tbody>
    </table>
    <style>
        p {
            font-size: 17px;
            padding: 5px;
        }
    </style>
    <?php include '../includes/pagination.php' ?>
</div>
<?php include '../templates/nav_admin2.php' ?>