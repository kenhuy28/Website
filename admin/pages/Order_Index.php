<?php
include '../templates/nav_admin1.php';
include '../includes/check_permisson.php';
check($nv->maLoai,'DDH');
?>


<style>
    th {
        text-align: center;
    }

    input {
        color: white;
        border-radius: 5px;
        font-size: 185x;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;

    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

<h2>Đơn Đặt Hàng</h2>
<table class="table_dsadmin">
    <thead>
        <tr>
            <th>Mã đơn</th>
            <th>Tên khách</th>
            <th>Ngày Đặt</th>
            <th>Ngày Giao</th>
            <th>Tổng tiền</th>
            <th>Tình trạng</th>
            <th>Nhân viên phụ trách</th>
            <th>Chi tiết đơn hàng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php include '../includes/show_order_in_table.php' ?>
    </tbody>
</table>
<?php include '../includes/pagination.php' ?>

<?php include '../templates/nav_admin2.php' ?>