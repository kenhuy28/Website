<?php include '../templates/nav_admin1.php' ?>
<div class="table_header">
    <div class="search">
        <a href="@Url.Action("Search","Admin")">
            <i class="fa-solid fa-magnifying-glass"></i>
            <div class="search_title">
                Tìm kiếm nhanh
            </div>
        </a>
    </div>
    <div class="add_admin">
        <a href="@Url.Action("Create","Admin")">
            <i class="fa-solid fa-user-plus"></i>
            <div class="add_title">
                Thêm Admin
            </div>
        </a>
    </div>
</div>
<table class="table_dsadmin">
    <thead>
        <tr>
            <th style="width: 65px;">Mã Admin</th>
            <th style="width: 120px;">Họ tên Admin</th>
            <th style="width: 150px;">Địa chỉ</th>
            <th style="width: 80px;">Số điện thoại</th>
            <th style="width: 90px;">Loại tài khoản</th>
            <th style="width: 100px;">Tên đăng nhập</th>
            <th style="width: 75px;">Hình ảnh</th>
            <th style="width: 150px;">Email</th>
            <th style="width: 80px;">Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach (var item in Model)
        {
            <tr>
                <td>
                    @Html.DisplayFor(modelItem => item.MAADMIN)
                </td>
                <td>
                    @Html.DisplayFor(modelItem => item.HOTEN)
                </td>
                <td>
                    @Html.DisplayFor(modelItem => item.DIACHI)
                </td>
                <td>
                    @Html.DisplayFor(modelItem => item.DIENTHOAI)
                </td>
                <td>
                    @Html.DisplayFor(modelItem => item.LOAITKADMIN.TENLOAI)
                </td>
                <td>
                    @Html.DisplayFor(modelItem => item.TENDN)
                </td>
                <td>
                    <img src="@Url.Content("~/assest/img/ad_user/" + item.AVATAR)" alt="" style="width: 70px; height: 70px;">
                </td>
                <td>
                    @Html.DisplayFor(modelItem => item.EMAIL)
                </td>
                <td>
                    <a href="@Url.Action("Edit","Admin", new { id = item.MAADMIN })"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="@Url.Action("Delete","Admin", new { id = item.MAADMIN })"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="@Url.Action("Detail","Admin", new { id = item.MAADMIN })"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
        }


    </tbody>
</table>
@*<div align="center">@Html.PagedListPager(Model, page => Url.Action("DSAdmin", new { page = page }))</div>*@

<ul class="page">
    @if (Model.PageCount > 1)
    {
        for (int i = 1; i <= Model.PageCount; i++)
        {
            <li>
                <a href="@Url.Action("DSAdmin", new { page = i })" class="@((i == Model.PageNumber) ? "page_button page_button_active" : "page_button")">@i</a>
            </li>
        }
    }
</ul>
@*

    <div class="page">
         <div class="page_previous_button">
             <i class="fa-solid fa-angles-left"></i>
         </div>
         <div class="page_button page_button_active">
             1
         </div>
         <div class="page_button">
             2
         </div>
         <div class="page_button">
             3
         </div>
         <div class="page_button">
             4
         </div>
         <div class="page_button">
             5
         </div>
         <div class="page_behind_button">
             <i class="fa-solid fa-angles-right"></i>
         </div>
     </div>
*@ 

<?php include '../templates/nav_admin2.php' ?>