<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Thêm nhân viên</title>

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
        require_once("connect.php");
        $warning = "";
        if (isset($_POST['username'])) {
            $username = trim($_POST['username']);
        } else {
            $username = "";
        }
        if (isset($_POST['password'])) {
            $password = trim($_POST['password']);
        } else {
            $password = "";
        }
        if (isset($_POST['login']) && $username != "" && $password != "" ) {
            $result = mysqli_query($conn, "SELECT * FROM User where username = '$username' and password = '$password'");
            if (mysqli_num_rows($result) <> 0) {
                $warning = "Login successful";
                header("Location: 2_6.php");
                exit();
            } else {
                $warning = "Login failed";
            }
        }
    ?>

    <form align='center' action="login.php" method="post">

        <table style="width: 300px;">
            <thead>

                <th colspan="2" align="center">
                    <h3>LOGIN</h3>
                </th>
            </thead>
            <tr>
                <td colspan="2" align="center">
                    <h3 style="color: red;">
                        <?php echo $warning; ?>
                    </h3>
                </td>
            </tr>s
           
            <tr>
                <td>Username:</td>

                <td><input style="width: 80%;" colspan="1" type="text" name="username" value="<?php  ?>" /></td>

            </tr>
            <tr>
                <td>Password:</td>
                <td><input style="width: 80%;" colspan="1" type="text" name="password" value="<?php  ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1"><input type="submit" value="Login" name="login" />
                </td>
            </tr>
        </table>
    </form>




</body>



</html>