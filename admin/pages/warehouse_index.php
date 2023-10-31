<?php include '../templates/nav_admin1.php' ?>

<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="search">
            <a href="@Url.Action(" Search","Admin")">
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="search_title">
                    Tìm kiếm nhanh
                </div>
            </a>
        </div>
        <div class="add_admin">
            <a href="enter_product.php">
                <i class="fa-solid fa-user-plus"></i>
                <div class="add_title">
                    Thêm sản phẩm vào kho
                </div>
            </a>
        </div>
    </div>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th style="width: 65px;">Mã phiếu nhập</th>
                <th style="width: 65px;">Ngày nhập kho</th>
                <th style="width: 50px;">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <!-- hiển thị bảng nhập kho -->
            <?php include '../includes/show_warehouse_table.php' ?>
        </tbody>
    </table>
    <!-- phân trang -->
    <?php include $_SESSION['rootPath'] . "/includes/pagination.php" ?>
</div>

<?php include '../templates/nav_admin2.php' ?>