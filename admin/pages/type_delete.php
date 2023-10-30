<?php
include '../templates/nav_admin1.php';
$type_id = $_GET['id'];

$statement = $dbh->prepare("SELECT * FROM `loai_san_pham` WHERE `maLoai` = '" . $type_id . "'");
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
$result = $statement->fetch();
if (isset($_POST["delete"])) {
    $statement = $dbh->prepare("DELETE FROM `loai_san_pham` WHERE `maLoai` = '" . $type_id . "'");
    $statement->execute();
    echo '<script>window.location.href = "type_index.php";</script>';
}
?>

<div class="detail_admin">
    <h1 class="Title_Admin_create_form">BẠN CÓ MUỐN XÓA LOẠI NÀY?</h1>
    <!-- @using (Html.BeginForm("Delete", "Loai", FormMethod.Post, new { @enctype = "multipart/form-data" }))
    { -->
    <form action="">
        <div class="detai_admin_form">
            <div class="detail_admin_right">
                <table class="Table_Details_Admin">
                    <tr>
                        <td>Mã loai: </td>
                        <td>
                            <?php echo $result->maLoai; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tên Loai:</td>
                        <td>
                            <?php echo $result->tenLoai; ?>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="button">
            <input type="submit" value="Xóa" class="button_add_admin delete_display_alert" />
            <a href="javascript:history.go(-1);"><input type="button" value="Quay lại" class="button_add_admin" /></a>
        </div>
    </form>
</div>
<?php include '../templates/nav_admin2.php' ?>