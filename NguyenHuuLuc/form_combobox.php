<?php
include '../templates/header.php';
?>

<html>

<head>

    <title>Input/Ouput data</title>
</head>

<body>

    <form method="POST" action="">

        <select name="lunch">

            <option value="pork" <?php if (isset($_POST['lunch']) && $_POST['lunch'] == 'pork')
                echo 'selected'; ?>>

                BBQ Pork Bun

            </option>

            <option value="chicken" <?php if (isset($_POST['lunch']) && $_POST['lunch'] == 'chicken')
                echo 'selected'; ?>>

                Chicken Bun

            </option>

            <option value="lotus" <?php if (isset($_POST['lunch']) && $_POST['lunch'] == 'lotus')
                echo 'selected'; ?>>

                Lotus Seed Bun

            </option>

        </select>

        <input type="submit" name="submit" value="Submit your order">

    </form>

    Selected buns:<br />

    <?php

    if (isset($_POST['lunch'])) {

        print 'You want a ' . $_POST["lunch"] . ' bun. <br/>';

    }

    ?>

    <button type="button" onclick="window.history.go(-1);">Quay lại</button>
</body>

</html>

<?php include '../templates/footer.php' ?>