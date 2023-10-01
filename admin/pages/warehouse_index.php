<?php include '../templates/nav_admin1.php' ?>

<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="search">
            <a href="@Url.Action(" Search","Admin")">
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="search_title">
                    Tìm kiếm nhanh
                </div>
            </a>
        </div>
        <div class="add_admin">
            <a href="enter_product.php">
                <i class="fa-solid fa-user-plus"></i>
                <div class="add_title">
                    Thêm sản phẩm vào kho
                </div>
            </a>
        </div>
    </div>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th style="width: 65px;">Mã phiếu nhập</th>
                <th style="width: 65px;">Ngày nhập khẩu</th>
                <th style="width: 120px;">Mã sản phẩm</th>
                <th style="width: 120px;">Tên sản phẩm</th>
                <th style="width: 150px;">Số lượng nhập</th>
                <th style="width: 50px;">Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    PN001
                </td>
                <td>
                    06/06/2023
                </td>
                <td>
                    SP00000001
                </td>
                <td>
                    Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g
                </td>
                <td>
                    20
                </td>
                <td>
                    <a href="/PhieuNhapKho/Edit/PN001"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="/PhieuNhapKho/Delete/PN001"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="/PhieuNhapKho/Detail/PN001"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                    PN002
                </td>
                <td>
                    07/06/2023
                </td>
                <td>
                    SP00000001
                </td>
                <td>
                    Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g
                </td>
                <td>
                    100
                </td>
                <td>
                    <a href="/PhieuNhapKho/Edit/PN002"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="/PhieuNhapKho/Delete/PN002"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="/PhieuNhapKho/Detail/PN002"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                    PN003
                </td>
                <td>
                    07/06/2023
                </td>
                <td>
                    SP00000002
                </td>
                <td>
                    Hạt Chó Trên 6 Tháng ANF 6Free Hữu Cơ
                </td>
                <td>
                    80
                </td>
                <td>
                    <a href="/PhieuNhapKho/Edit/PN003"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="/PhieuNhapKho/Delete/PN003"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="/PhieuNhapKho/Detail/PN003"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                    PN004
                </td>
                <td>
                    07/06/2023
                </td>
                <td>
                    SP00000004
                </td>
                <td>
                    Pate Lon Whiskas Cho Mèo Trưởng Thành 400g
                </td>
                <td>
                    10
                </td>
                <td>
                    <a href="/PhieuNhapKho/Edit/PN004"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="/PhieuNhapKho/Delete/PN004"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="/PhieuNhapKho/Detail/PN004"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                    PN005
                </td>
                <td>
                    07/06/2023
                </td>
                <td>
                    SP0000006
                </td>
                <td>
                    Pate Mèo Ciao 6 Vị Thơm Ngon 60g
                </td>
                <td>
                    20
                </td>
                <td>
                    <a href="/PhieuNhapKho/Edit/PN005"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="/PhieuNhapKho/Delete/PN005"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="/PhieuNhapKho/Detail/PN005"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                    PN006
                </td>
                <td>
                    07/06/2023
                </td>
                <td>
                    SP0000009
                </td>
                <td>
                    Pate Mèo Ciao 6 Vị Thơm Ngon 60g
                </td>
                <td>
                    30
                </td>
                <td>
                    <a href="/PhieuNhapKho/Edit/PN006"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="/PhieuNhapKho/Delete/PN006"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="/PhieuNhapKho/Detail/PN006"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>


        </tbody>
    </table>
    <style>
        .pagination {
            display: inline-block;
            margin: auto;

        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            font-size: 22px;
        }

        .pagination a.active {
            background-color: #244cbb;
            color: white;
            border: 1px solid #244cbb;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
    <div align="center">
        <ul class="page pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a href="#" class="active">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">7</a>
            <a href="#">&raquo;</a>
        </ul>
    </div>
</div>

<?php include '../templates/nav_admin2.php' ?>