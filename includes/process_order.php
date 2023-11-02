<?php
include("config.php");
//tạo mã đơn hàng tự động tăng
$maDonHang = "DH";
$query = "SELECT MAX(CAST(SUBSTRING(don_dat_hang.maDonHang, 4) AS SIGNED)) AS max_id FROM don_dat_hang";
$statement = $dbh->prepare($query);
$statement->execute();
$count = $statement->fetchColumn() + 1;
$index = strval($count);
$temp = array("", "0", "00", "000");
$maDonHang = $maDonHang . $temp[4 - strlen($index)] . $index;
// các thông tin còn lại của đơn đặt hàng
$maKhachHang = $_SESSION["taiKhoan"]["maKhachHang"];
date_default_timezone_set("Asia/Ho_Chi_Minh");
$ngayDat = date("Y-m-d H:i:s");
$tongTien = str_replace(".", "", $_POST["tongTien"]);
// thực hiện tạo đơn hàng
$query = "INSERT INTO `don_dat_hang` (`maDonHang`, `maKhachHang`, `ngayDat`, `ngayGiao`, `tinhTrang`, `daThanhToan`, `tongTien`, `maNhanVien`) VALUES ('$maDonHang', '$maKhachHang', '$ngayDat', NULL, b'01', b'0', '$tongTien', NULL)";
$statement = $dbh->prepare($query);
$statement->execute();
// lấy thông tin giỏ hàng hiện tại
$get_giohang = $dbh->prepare(
  "SELECT 
        gio_hang.soLuong, 
        san_pham.maSanPham, 
        san_pham.donGiaBan, 
        IFNULL(giam_gia.loaiGiamGia, 0) AS loaiGiamGia, 
        IFNULL(
            CASE 
                WHEN giam_gia.ngayBatDau <= CURDATE() AND giam_gia.ngayKetThuc >= CURDATE() THEN giam_gia.giaTriGiam 
                ELSE 0 
            END, 
            0
        ) AS giaTriGiam 
    FROM gio_hang 
    JOIN san_pham ON gio_hang.maSanPham = san_pham.maSanPham 
    LEFT JOIN giam_gia ON san_pham.maSanPham = giam_gia.maSanPham 
    WHERE gio_hang.maKhachHang = '" . $maKhachHang . "'"
);
$get_giohang->execute();
$get_giohang->setFetchMode(PDO::FETCH_OBJ);
while ($row = $get_giohang->fetch()) {
  // đưa từng sản phẩm trong giỏ vào chi tiết đơn đặt hàng
  $maSanPham = $row->maSanPham;
  $soLuong = $row->soLuong;
  $donGia = $row->donGiaBan;
  $thanhTien = (($row->loaiGiamGia == 1) ? (($row->donGiaBan - $row->giaTriGiam) * $row->soLuong) : (($row->donGiaBan - $row->donGiaBan * $row->giaTriGiam / 100) * $row->soLuong));
  $insert_chddh = "INSERT INTO `chi_tiet_don_dat_hang` VALUES ('$maDonHang', '$maSanPham', '$soLuong', '$donGia', '$thanhTien')";
  $insert = $dbh->prepare($insert_chddh);
  $insert->execute();
  echo $maSanPham;
}

// xóa giỏ hàng sau khi đặt
$delete_giohang = "DELETE FROM gio_hang WHERE gio_hang.maKhachHang = '$maKhachHang'";
$delete_giohang = $dbh->prepare($insert_chddh);
$delete_giohang->execute();

// đặt xong về trang báo đặt thành công
header("Location: ../pages/cart_confirm_order.php");

?>