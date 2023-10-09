<?php include '../templates/header.php' ?>
<div class="body" style="margin-top: 50px">
    <h6 style="font-size: 24px; text-align: center;">Danh sách thương hiệu</h6>
    <div class="grid">
        <div class="row">
            <?php
            for ($i = 0; $i < 10; $i++) {
                echo "<div class=\"thuongHieu\" style=\"margin: 10px;\">

                    <a href=\"\">
                        <img src=\"https://webkit.org/demos/srcset/image-src.png\" alt=\"\"
                            style=\"width: 100%; height: 80px;\">
                        <h6>
                            @item.TENTH
                        </h6>
                    </a>
    
                </div>";
            }
            ?>

        </div>
    </div>
</div>
<?php include '../templates/footer.php' ?>