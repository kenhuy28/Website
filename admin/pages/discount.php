<?php include '../templates/nav_admin1.php';
include '../includes/check_permisson.php';
check($nv->maLoai, 'GG');
?>

<div class="table_header">
    <div class="add_admin">
        <a href="type_create.php">
            <i class="fa-solid fa-user-plus"></i>
            <div class="add_title">
                Thêm Giảm giá
            </div>
        </a>
    </div>
</div>
<table class="table_dsadmin">
    <thead>
        <tr>
            <th style="width: 65px;">Tên sản phẩm</th>
            <th style="width: 120px;">Loại giảm giá</th>
            <th style="width: 80px;">Giá trị giảm</th>
            <th style="width: 80px;">Ngày bắt đầu</th>
            <th style="width: 80px;">Ngày kết thúc</th>
        </tr>
    </thead>
    <tbody>
        <?php include '../includes/show_discount_table.php' ?>
    </tbody>
</table>
<div align="center" style="margin-top:10px" class="menu-wrapper">
    <ul class="pagination menu">
        <?php include '../includes/pagination.php'; ?>

    </ul>
</div>
<?php include '../templates/nav_admin2.php' ?>