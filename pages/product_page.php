<!--product page-->
<?php include '../templates/header.php';
    require_once('../includes/config.php');
    
?>

<h6>Trang chủ > Sản phẩm </h6>
<h4>Tất cả sản phẩm</h4>
<div class="product_search">
    <div class="icon_search">
        <i class="fa-solid fa-filter"></i>
    </div>
    <div class="product_search_item search_search">
        <h3>THƯƠNG HIỆU </h3>
        <div>
            <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="product_search_item_list">
            <ul>
                <a href="">
                    <li>
                        Paddy
                    </li>
                </a>
                <a href="">
                    <li>
                        Paddy
                    </li>
                </a>
                <a href="">
                    <li>
                        Paddy
                    </li>
                </a>
                <a href="">
                    <li>
                        Paddy
                    </li>
                </a>
            </ul>
        </div>
    </div>
    <div class="product_search_item search_search">
        <h3>GIÁ</h3>
        <div>
            <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="product_search_item_list search_search_search" style="height: 150px;">
            <div class="input_saerch">
                <input type="text" class="textfile" style="width: 100px;">
                <h5 style="margin:0"> đến </h5>

                <input type="text" class="textfile" style="width: 100px;">
            </div>
            <input type="submit" value="Áp Dụng" class="button_add_admin"
                style="width: 100px; margin: 10px 0 0 90px;" />
        </div>
    </div>
    <div class="product_search_item search_search">
        <h3>LOẠI SẢN PHẨM </h3>
        <div>
            <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="product_search_item_list">
            <ul>
                <a href="">
                    <li>
                        Cho chó
                    </li>
                </a>
                <a href="">
                    <li>
                        Cho mèo
                    </li>
                </a>
                <a href="">
                    <li>
                        Paddy
                    </li>
                </a>
                <a href="">
                    <li>
                        Paddy
                    </li>
                </a>

            </ul>
        </div>
    </div>
</div>
<div class="divider">

</div>
<div class="product_list">
    <div class="grid">
        <div class="row">
            <div class="product_item">
                <img src="assest/img/img_product/12-1682483525450_1066x.webp" alt="">
                <div class="product_thuonghieu">
                    <h5>Paddy</h5>
                </div>
                <div class="product_name">
                    <h5>Bát Ăn Cho Chó Mèo Bằng Nhựa Hình Mèo May Mắn</h5>
                </div>
                <div class="product_price">
                    <h5>55.000đ</h5>
                </div>
                <button class="button_product">Thêm vào giỏ hàng</button>
                <div class="xem_icon">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>
           
            
            </div>
        </div>
    </div>
</div>
<?php include '../templates/footer.php' ?>