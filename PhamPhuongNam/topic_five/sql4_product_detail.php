<style>
    th{
        font-size:50px;
        color:orange;
    }
</style>
<?php
if (isset($_GET['id'])) {
   
    $conn = mysqli_connect('localhost', 'root', '', 'qlbansua');
    mysqli_set_charset($conn, 'UTF8');
    $Ma_sua = $_GET['id'];
    
    // Kết nối cơ sở dữ liệu ở đây
    
    // Truy vấn để lấy thông tin sản phẩm dựa trên productID
   
    $result = mysqli_query($conn, "SELECT * FROM sua join hang_sua on sua.Ma_hang_sua = hang_sua.Ma_hang_sua WHERE Ma_sua = '$Ma_sua'");
   
    if (mysqli_num_rows($result) <>0) {
        $row = mysqli_fetch_assoc($result);
        
        // Hiển thị thông tin sản phẩm
        echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>
        <tr>
            <th colspan='2'>{$row['Ten_sua']} - {$row['Ten_hang_sua']}</th>
            
        </tr>
        <tr>
            <td width=30><img src='../img/{$row['Hinh']}' /></td>
            <td>
                <b style='display:block'><i>Thành phần dinh dưỡng</i></b>
                <p>{$row['TP_Dinh_Duong']}</p>
                <b style='display:block'><i>Lợi ích</i></b>
                <p>{$row['Loi_ich']}</p>
                <p align='right'><b><i>Trọng lượng: </i></b>{$row['Trong_luong']} - <b><i>Đơn giá: </i></b>{$row['Don_gia']} VND</p>
            </td>
        </tr>
        <tr> <td><a href='sql4.php'>Quay lại</a></td></tr>
   </table>";
        // Thêm nút quay trở về danh sách sản phẩm
       
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
} else {
    echo "Thiếu thông tin sản phẩm.";
}
?>
   