<?php include '../templates/nav_admin1.php' ?>
<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="search">
            <a href="#">
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="search_title">
                    Tìm kiếm nhanh
                </div>
            </a>
        </div>
        <div class="add_admin">
            <a href="product_create.php">
                <i class="fa-solid fa-user-plus"></i>
                <div class="add_title">
                    Thêm sản phẩm
                </div>
            </a>
        </div>
    </div>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th style="width: 65px;">Mã San Phẩm </th>
                <th style="width: 180px;">Tên Sản Phẩm</th>
                <th style="width: 84px;">Giá mua</th>
                <th style="width: 84px;">Giá bán</th>
                <th style="width: 170px;">Thương hiệu</th>
                <th style="width: 100px;">Loại</th>
                <th style="width: 70px;">Số lượng</th>
                <th style="width: 250px;">Mô tả</th>
                <th style="width: 70px;">Hình ảnh</th>
                <th style="width: 90px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>SP00000001</td>
                <td>Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g</td>
                <td>100.000 đ</td>
                <td>100.000 đ</td>
                <td>Nexgard</td>
                <td>Thức ăn cho mèo</td>
                <td>92</td>
                <td>Pate Tươi Cho Mèo Hỗn Hợp cho Chó Mèo Biếng Ăn được làm từ hỗn hợp cá biển và gan gà tươi nguyên
                    chất thích hợp dùng cho Chó Mèo.</td>
                <td>
                    <img src="https://webkit.org/demos/srcset/image-src.png" alt="" style="width: 70px; height: 70px;">
                </td>
                <td>
                    <a href="product_edit.php"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="product_delete.php"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="product_details.php"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            <tr>
                <td>SP00000001</td>
                <td>Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g</td>
                <td>100.000 đ</td>
                <td>100.000 đ</td>
                <td>Nexgard</td>
                <td>Thức ăn cho mèo</td>
                <td>92</td>
                <td>Pate Tươi Cho Mèo Hỗn Hợp cho Chó Mèo Biếng Ăn được làm từ hỗn hợp cá biển và gan gà tươi nguyên
                    chất thích hợp dùng cho Chó Mèo.</td>
                <td>
                    <img src="https://webkit.org/demos/srcset/image-src.png" alt="" style="width: 70px; height: 70px;">
                </td>
                <td>
                    <a href="product_edit.php"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="product_delete.php"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="product_details.php"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            <tr>
                <td>SP00000001</td>
                <td>Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g</td>
                <td>100.000 đ</td>
                <td>100.000 đ</td>
                <td>Nexgard</td>
                <td>Thức ăn cho mèo</td>
                <td>92</td>
                <td>Pate Tươi Cho Mèo Hỗn Hợp cho Chó Mèo Biếng Ăn được làm từ hỗn hợp cá biển và gan gà tươi nguyên
                    chất thích hợp dùng cho Chó Mèo.</td>
                <td>
                    <img src="https://webkit.org/demos/srcset/image-src.png" alt="" style="width: 70px; height: 70px;">
                </td>
                <td>
                    <a href="product_edit.php"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="product_delete.php"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="product_details.php"><i class="fa-solid fa-circle-info detail"></i></a>
                </td>
            </tr>
            <tr>
                <td>SP00000001</td>
                <td>Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g</td>
                <td>100.000 đ</td>
                <td>100.000 đ</td>
                <td>Nexgard</td>
                <td>Thức ăn cho mèo</td>
                <td>92</td>
                <td>Pate Tươi Cho Mèo Hỗn Hợp cho Chó Mèo Biếng Ăn được làm từ hỗn hợp cá biển và gan gà tươi nguyên
                    chất thích hợp dùng cho Chó Mèo.</td>
                <td>
                    <img src="https://webkit.org/demos/srcset/image-src.png" alt="" style="width: 70px; height: 70px;">
                </td>
                <td>
                    <a href="product_edit.php"><i class="fa-solid fa-pen-to-square edit"></i></a>
                    <a href="product_delete.php"> <i class="fa-solid fa-xmark remove"></i></a>
                    <a href="product_details.php"><i class="fa-solid fa-circle-info detail"></i></a>
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