<?php include '../templates/nav_admin1.php';

include '../includes/check_permisson.php';
check($nv->maLoai, 'NV');

$query = "SELECT maNhanVien, ho,ten,diaChiCuThe,dienThoai,tenLoai, tenNguoiDung, avatar, email FROM nhan_vien JOIN loai_tai_khoan ON nhan_vien.maLoai = loai_tai_khoan.maLoai;";
$stmt = $dbh->prepare($query);
$stmt->execute();
$nhanVien = $stmt->fetchAll(PDO::FETCH_OBJ);

$query_tenloai = "SELECT maLoai, tenLoai FROM loai_tai_khoan";
$statement = $dbh->prepare($query_tenloai);
$statement->execute();
$loaitaikhoan = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<div class="table_header">

    <div class="add_admin">
        <a href="./Admin_Create.php">
            <i class="fa-solid fa-user-plus"></i>
            <div class="add_title">
                Thêm Admin
            </div>
        </a>
    </div>
</div>
<table class="table_dsadmin">
    <thead>
        <tr>
            <th style="width: 65px;">Mã Nhân Viên</th>
            <th style="width: 120px;">Họ tên</th>
            <th style="width: 150px;">Địa chỉ</th>
            <th style="width: 80px;">Số điện thoại</th>
            <th style="width: 90px;">Loại tài khoản</th>
            <th style="width: 100px;">Tên đăng nhập</th>
            <th style="width: 75px;">Hình ảnh</th>
            <th style="width: 150px;">Email</th>
            <th style="width: 80px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($nhanVien as $row) {
            echo '
            <tr>
                <td>
                ' . $row->maNhanVien . '
                </td>
                <td>
                ' . $row->ho . " " . $row->ten . '
                </td>
                <td>
                ' . $row->diaChiCuThe . '
                </td>
                <td>
                ' . $row->dienThoai . '
                </td>
                <td>
                ' . $row->tenLoai . '
                </td>
                <td>
                ' . $row->tenNguoiDung . '
                </td>
                <td>
                    <img src="../../assets/img/ad_user/' . $row->avatar . '" alt="" style="width: 70px; height: 70px;">
                </td>
                <td>
                ' . $row->email . '
                </td>
                <td>
                        <a href="./Admin_editPQ.php?maNhanVien=' . $row->maNhanVien . '" ><i class="fa-solid fa-pen-to-square edit"></i></a>
                        
                        <a href="./Admin_delete.php?maNhanVien=' . $row->maNhanVien . '" ><i class="fa-solid fa-xmark remove"></i></a>
                        <a href="./Admin_DetailsDs.php?maNhanVien=' . $row->maNhanVien . '"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            ';
        }
        ?>
    </tbody>


</table>
<?php include '../templates/nav_admin2.php' ?>