<?php include("../templates/header.php") ?>
<div style="font-size: 20px;">
    <b>Những thông tin bạn đã nhập</b> <br><br>
    Họ tên:
    <?php echo $_POST['hoTen']; ?> <br><br>
    Giới tính:
    <?php
    if ($_POST['gioiTinh'] == "nu")
        echo "Nữ";
    else
        echo "Nam"; ?> <br><br>
    Địa chỉ:
    <?php echo $_POST['diaChi']; ?> <br><br>
    Điện thoại:
    <?php echo $_POST['sdt']; ?> <br><br>
    Quốc tịch:
    <?php switch ($_POST['quocTich']) {
        case 'VN':
            echo "Việt Nam";
            break;
        case 'US':
            echo "Anh";
            break;
        case 'CN':
            echo "Trung Quốc";
            break;
    } ?> <br><br>
    Môn học:
    <?php
    $monHoc = array();
    if (isset($_POST['chk1']))
        $monHoc[] = $_POST['chk1'];
    if (isset($_POST['chk2']))
        $monHoc[] = $_POST['chk2'];
    if (isset($_POST['chk3']))
        $monHoc[] = $_POST['chk3'];
    if (isset($_POST['chk4']))
        $monHoc[] = $_POST['chk4'];
    $strMonHoc = implode(', ', $monHoc);
    echo $strMonHoc;
    ?>
    <br><br>
    Ghi chú:
    <?php echo $_POST['comment']; ?> <br><br>
</div>
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>