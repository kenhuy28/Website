<?php include '../templates/nav_admin1.php';
$nhanVien_id = $_GET['maNhanVien'];
$query = "SELECT maNhanVien, ho,ten,diaChiCuThe,dienThoai,tenLoai, tenNguoiDung, avatar, email FROM nhan_vien JOIN loai_tai_khoan ON nhan_vien.maLoai = loai_tai_khoan.maLoai WHERE maNhanVien = '$nhanVien_id';";
$stmt = $dbh->prepare($query);
$stmt->execute();
$nhanVien = $stmt->fetch(PDO::FETCH_OBJ);
$query_loaiTK = "SELECT maLoai,tenLoai FROM loai_tai_khoan;";
$statement = $dbh->prepare($query_loaiTK);
$statement->execute();
$loaiTK = $statement->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["save"])) {
    $newLoaiTK = $_POST["loaitaikhoan"];
    $updateQuery = "UPDATE nhan_vien SET maLoai = '$newLoaiTK' WHERE maNhanVien = '$nhanVien_id'";
    $updateStatement = $dbh->prepare($updateQuery);
    if ($updateStatement->execute()) {
        echo "Đã sửa thành công";
    } else {
        echo "Không sửa được";
    }

}
?>
<h3>CHỈNH SỬA QUYỀN CHO TÀI KHOẢN</h3>
<script type="text/javascript">
    function reloadPage() {
        location.reload();
    }
</script>
<table class="table_dsadmin">
    <thead>
        <tr>
            <th style="width: 120px;">Họ tên</th>
            <th style="width: 90px;">Loại tài khoản</th>
            <th style="width: 80px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php echo $nhanVien->ho . ' ' . $nhanVien->ten;
                ?>
            </td>
            <form method="POST">
                <td>
                    <select name="loaitaikhoan">
                        <?php
                        foreach ($loaiTK as $row) {
                            echo '<option value="' . $row->maLoai . '">' . $row->tenLoai . '</option>';
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <form method="POST">
                        <button name="save" value="<?php echo $nhanVien->maLoai; ?>" onclick="reloadPage()">Lưu</button>
                    </form>

                </td>
            </form>
        </tr>
    </tbody>

</table>


<br>
<a href="./Admin_DsAdmin.php"><button type="button" class="btn-success">Quay Lại</button></a>
<?php include '../templates/nav_admin2.php' ?>