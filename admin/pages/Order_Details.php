<?php
include '../templates/nav_admin1.php';

$id = $_GET['id'];
?>

<h2>Mã đơn hàng:
    <?php echo $id; ?>
</h2>
<h2>Chi tiết đơn đạt hàng:</h2>
<table class="table_dsadmin">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php include '../includes/show_order_details_table.php' ?>
    </tbody>
</table>
<div align="center" style="margin-top:10px" class="menu-wrapper">
    <ul class="pagination menu">
        <!-- phân trang -->
        <?php include '../includes/paging_with_id.php' ?>

    </ul>
</div>

<?php include '../templates/nav_admin2.php' ?>