
<?php
include '../templates/header.php';
?>



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
    $d=0;
    if (isset($_POST['name'])) {
        $name = trim($_POST['name']);
    } else {
        $name = "";
    }
    if (isset($_POST['a'])) {
        $a = trim($_POST['a']);
    } else {
        $a = 0;
    }

    if (isset($_POST['b'])) {
        $b = trim($_POST['b']);
    } else {
        $b = 0;
    }
    if (isset($_POST['c'])) {
        $c = trim($_POST['c']);
    } else {
        $c = 2000;
    }
    if ($a<$b && $c!=0) {
        $d=($b-$a)*$c;
    }
    ?>

        <form align='center' action="2_2.php" method="post">
        
            <table>
                <thead>

                    <th colspan="3" align="center"><h3>THANH TOÁN TIỀN ĐIỆN</h3></th>
                </thead>
                <tr>
                    <td>Tên chủ hộ:</td>

                    <td><input colspan="2" type="text" name="name" value="<?php echo $name; ?>" /></td>

                </tr>
                <tr>
                    <td>Chỉ số cũ:</td>

                    <td><input colspan="2" type="number" name="a" value="<?php echo $a; ?>" /></td>
                    <td>(Kw)</td>

                </tr>
                <tr>
                    <td>Chỉ số mới:</td>

                    <td><input type="number" name="b" value="<?php echo $b; ?>" type="number"/></td>
                    <td>(Kw)</td>
                </tr>
                <tr>
                    <td>Đơn giá:</td>

                    <td><input type="number" name="c" value="<?php echo $c; ?>" type="number"/></td>
                    <td>VNĐ</td>
                </tr>
                <tr>
                    <td>Số tiền thanh toán:</td>

                    <td><input type="text" name="d" disabled value="<?php echo $d; ?>" type="number"/></td>
                    <td>VNĐ</td>
                </tr>
                </tr>



                <tr>

                        <td colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>

                </tr>




            </table>



        </form>




        <?php include '../templates/footer.php' ?>