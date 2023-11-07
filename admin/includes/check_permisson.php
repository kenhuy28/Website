<?php
function check($loai, $trang) {
    $mk_pan = ['TK','KH'];
    $sale_pan = ['TK','NK'];
    if ($loai == 'LTK002') {
        if (in_array($trang, $mk_pan)) { 
            header('Location: ../pages/access_permisson.php');
            exit();
        } 
    }
}
if (empty($_SESSION['admin'])) {
    header('Location: ./pages/Admin_Login.php');
    exit();
} else {
    $sql = "SELECT * FROM nhan_vien JOIN loai_tai_khoan ON nhan_vien.maLoai = loai_tai_khoan.maLoai WHERE nhan_vien.maNhanVien = '{$_SESSION['admin']->maNhanVien}' ";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
}

?>