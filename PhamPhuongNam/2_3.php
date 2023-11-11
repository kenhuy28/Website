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

</head>



<body>

    <?php
    $check = true;
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
    if (isset($_POST['option'])) {
        $d = trim($_POST['option']);
    } else {
        $d = "";
    }
    if (isset($_POST['c'])) {
        $c = trim($_POST['c']);
    } else {
        $c = 0;
    }

    $phep = "cộng";

    switch ($d) {
        case "+":
            $c = $a + $b;
            $check = false;
            break;
        case "-":
            $c = $a - $b;
            $phep = "trừ";
            $check = false;
            break;
        case "*":
            $c = $a * $b;
            $phep = "nhận";
            $check = false;
            break;
        case "/":
            $c = $a / $b;
            $phep = "chia";
            $check = false;
            break;
    }
    ?>

    <fieldset>
        <legend>Enter your infomation</legend>
        <form align='center' action="2_3.php" method="post">

            <table>
                <tr>
                    <td>Phép tính</td>
                    <?php
                    if ($check == true) {
                        echo '<td>
            <input type="radio" name="option" value="+" checked> +
            <input type="radio" name="option" value="-"> -
            <input type="radio" name="option" value="x"> x
            <input type="radio" name="option" value="/"> /
        </td>';
                    } else {
                        echo '<td>' . $phep . '</td>';
                    }
                    ?>

                </tr>

                <tr>
                    <td>Số thứ nhất:</td>

                    <td><input type="text" name="a" value="<?php echo $a; ?>" /></td>

                </tr>

                <tr>
                    <td>Số thứ hai:</td>

                    <td><input type="text" name="b" value="<?php echo $b; ?>" /></td>

                </tr>
                <tr>
                    <td>Kết quả:</td>

                    <td><input type="text" name="c" value="<?php echo $c; ?>" /></td>

                </tr>
                </tr>



                <tr>
                    <?php
                    if ($check == true) {
                        echo '<td colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>';
                    } else {
                        echo '<td colspan="2" align="center"> <a href="javascript:window.history.back(-1);">Tro ve trang truoc</a> </td>';
                    }
                    ?>

                </tr>
            </table>



        </form>
    </fieldset>




    <?php include '../templates/footer.php' ?>