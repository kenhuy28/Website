<?php
include '../templates/header.php';
?>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>tinh dien tich HCN</title>

    <style type="text/css">
        body {

            background-color: #d24dff;

        }

        table {

            background: #ffd94d;

            border: 0 solid yellow;

        }

        thead {

            background: #fff14d;

        }

        td {

            color: blue;

        }

        h3 {

            font-family: verdana;

            text-align: center;

            /* text-anchor: middle; */

            color: #ff8100;

            font-size: medium;

        }
    </style>




<body>

    <?php
    if (isset($_POST['a'])) {
        $a = trim($_POST['a']);
    } else {
        $a = 0;
    }
    function convertToLunarYear($nam, &$hinh, &$b)
    {
        $nam_chi = array(
            'Hợi',
            'Tý',
            'Sửu',
            'Dần',
            'Mão',
            'Thìn',
            'Tỵ',
            'Ngọ',
            'Mùi',
            'Thân',
            'Dậu',
            'Tuất',
            
        );
        $nam_hinh = array(
            "hoi.jpg",
            "chuot.jpg",
            "suu.jpg",
            "dan.jpg",
            "meo.jpg",
            "thin.jpg",
            "ty.jpg",
            "ngo.jpg",
            "mui.jpg",
            "than.jpg",
            "dau.jpg",
            "tuat.jpg"
            
        );
        $nam_can = array('Quý', 'Giáp', 'Ất', 'Bính', 'Đinh', 'Mậu', 'Kỷ', 'Canh', 'Tân', 'Nhâm');
        $nam = $nam - 3;
        //echo $nam;
        $can = $nam % 10;
        $chi = $nam % 12;
        $b = $nam_can[$can];
        $b .= $nam_chi[$chi];
        $hinh = "<img src='images/".$nam_hinh[$chi]."'>";
    }
    if($a!=0) {
        $hinh ="";
        convertToLunarYear($a,$hinh,$b);
        //echo $b;
    } else {
        $b="";
        $hinh ="";
    }
    ?>



    <form align='center' action="" method="post">
        <table>
            <thead>
                <td colspan="3" align="center">Tính năm âm lịch</td>
            </thead>
            <tr>
                <td align="center">Năm dương lịch</td>
                <td align="center"></td>
                <td align="center">Năm âm lịch</td>
            </tr>
            <tr>
                <td align="center">
                    <input type="number" name="a"  value="<?php echo $a; ?>" />
                </td>
                <td align="center"><input type="submit" value="=>" name="tinh" /></td>
                <td align="center">
                    <input type="text" value="<?php echo $b;?>"/>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center"><?php echo $hinh;?> </td>
            </tr>
        </table>
    </form>

</body>


<?php include '../templates/footer.php' ?>