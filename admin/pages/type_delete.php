<?php
include '../templates/nav_admin1.php';
$type_id = $_GET['id'];

$statement = $dbh->prepare("SELECT * FROM `loai_san_pham` WHERE `maLoai` = '" . $type_id . "'");
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
$result = $statement->fetch();

if (isset($_POST["delete"])) {
    $statement = $dbh->prepare("SELECT * FROM `san_pham` WHERE `maLoai` = '" . $type_id . "'");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $result = $statement->fetch();

    if ($statement->rowCount() == 0) {
        $statement = $dbh->prepare("DELETE FROM `loai_san_pham` WHERE `maLoai` = '" . $type_id . "'");
        $statement->execute();

    } else {
        echo "<script>
            alert(\"Loại sản phẩm này đang kinh doanh\");
        </script>";

    }
    echo '<script>window.location.href = "type_index.php";</script>';
}
?>

<div class="detail_admin">
    <h1 class="Title_Admin_create_form">BẠN CÓ MUỐN XÓA LOẠI NÀY?</h1>
    <form action="" method="post">
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
            <input type="button" value="Xóa" class="button_add_admin delete_display_alert" />
            <a href="javascript:history.go(-1);"><input type="button" value="Quay lại" class="button_add_admin" /></a>
        </div>
        <div class="alert_delete">
            <div class="notification" style="width:20%  ">
                <h1 class="notification_title">Xác nhận xóa loại sản phẩm!</h1>
                <input type="submit" name="delete" value="Xóa" class="alert_delete_btn delete_conform" />
                <input type="button" value="Không" class="alert_delete_btn delete_cancel" />
            </div>
        </div>
    </form>
</div>
<script>
    const load = document.querySelector.bind(document);
    const alert_delete_btn = load(".delete_display_alert");
    const alert_delete_conform_btn = load(".delete_conform");
    const alert_delete_cancel_btn = load(".delete_cancel");
    const alert_delete = load(".alert_delete");
    alert_delete_btn.onclick = () => {
        alert_delete.style.display = "block";
    };
    alert_delete_cancel_btn.onclick = () => {
        alert_delete.style.display = "none";
    };
</script>
<?php include '../templates/nav_admin2.php' ?>