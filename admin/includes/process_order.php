<?php
$maDonHang = $_GET['id'];
$hanhDong = $_GET['nut'];

if ($hanhDong == 'huy') {
    echo "hủy";
} else if ($hanhDong == "xacNhan") {
    echo "xác nhận";
} else {
    echo "Giao";
}
?>