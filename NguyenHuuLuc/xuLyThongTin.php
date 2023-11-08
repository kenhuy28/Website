<html>

<body>
    <h1><b>Bạn đã đăng nhập thành công, dưới đây là những thông tin bạn đã nhập:</b></h1>
    <br>
    Họ tên:
    <?php echo $_POST['hoTen']; ?> <br>
    Giới tính:
    <?php
    if ($_POST['gioiTinh'] == "nu")
        echo "Nữ";
    else
        echo "Nam"; ?> <br>
    Địa chỉ:
    <?php echo $_POST['diaChi']; ?> <br>
    Điện thoại:
    <?php echo $_POST['sdt']; ?> <br>
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
    } ?> <br>
    Môn học:
    <?php
    if (isset($_POST['ck1']))
        echo $_POST['ck1'];
    if (isset($_POST['ck2']))
        echo $_POST['ck2'];
    if (isset($_POST['ck3']))
        echo $_POST['ck3'];
    if (isset($_POST['ck4']))
        echo $_POST['ck4'];
    ?>
    Ghi chú:
    <?php echo $_POST['comment']; ?> <br>
    <a href="javascript:history.go(-1);" style="color:blue;"><i>Quay lại trang trước</i></a>
</body>


</html>