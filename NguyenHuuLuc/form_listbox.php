<?php
include '../templates/header.php';
?>

<html>

<head>

    <title>Input/Ouput data</title>
</head>

<body>

    <form method="POST" action="">

        <select name="lunch[]" multiple>

            <option value="pork" selected>

                BBQ Pork Bun

            </option>

            <option value="chicken">

                Chicken Bun

            </option>

            <option value="lotus">

                Lotus Seed Bun

            </option>

        </select>

        <p>

            <input type="submit" name="submit" value="Submit your order">

    </form>



    Selected buns:<br />

    <?php

    if (isset($_POST['lunch'])) {

        foreach ($_POST['lunch'] as $choice) {

            print "You want a $choice bun. <br/>";

        }



    }

    ?>

    <button type="button" onclick="window.history.go(-1);">Quay lại</button>
</body>

</html>

<?php include '../templates/footer.php' ?>