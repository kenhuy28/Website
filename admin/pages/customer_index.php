<?php include '../templates/nav_admin1.php' ?>



<div class="table_header">
    <div class="search">
        <a href="@Url.Action("Search","KhachHang")">
            <i class="fa-solid fa-magnifying-glass"></i>
            <div class="search_title">
                Tìm kiếm nhanh
            </div>
        </a>
    </div>
</div>
<table class="table_dsadmin">
    <thead>
        <tr>
            <th style="width: 65px;">Mã khách hàng</th>
            <th style="width: 120px;">Họ tên</th>
            <th style="width: 150px;">Địa chỉ</th>
            <th style="width: 80px;">Số điện thoại</th>
            <th style="width: 90px;">Ngày sinh</th>
            <th style="width: 150px;">Email</th>
            <th style="width: 75px;">Hình ảnh</th>
            <th style="width: 80px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        <?php  
        // foreach ($variable as $key => $value) {
        //     # code...
        // } 
        ?> 
            <tr>
                <td>
                    MAKH
                </td>
                <td>
                HOTENKH
                </td>
                <td>
                DIACHI
                </td>
                <td>
                DIENTHOAI
                </td>
                <td>
                NGAYSINH
                </td>
                <td>
                EMAIL
                </td>
                <!-- @if (item.HINHANH == null)
                {
                    <td style="height:90px">
                        Không có ảnh
                    </td>
                }
                else
                { -->
                    <td >
                        <img src="../../assets/img/khach_hang/images.jpg" alt="" style="width: 70px; height: 70px;">
                    </td>
                <!-- } -->

                <td>                  
                    <a href="@Url.Action("Delete","KhachHang", new { id = item.MAKH })"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="@Url.Action("Detail","KhachHang", new { id = item.MAKH })"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
        


    </tbody>
</table>
<!-- @*<div align="center">@Html.PagedListPager(Model, page => Url.Action("DSAdmin", new { page = page }))</div>*@ -->
<!-- hiện số trang -->
<!-- <ul class="page">
    @if (Model.PageCount > 1)
    {
        for (int i = 1; i <= Model.PageCount; i++)
        {
            <li>
                <a href="@Url.Action("Index", new { page = i })" class="@((i == Model.PageNumber) ? "page_button page_button_active" : "page_button")">@i</a>
            </li>
        }
    }
</ul> -->

<?php include '../templates/nav_admin2.php' ?>
