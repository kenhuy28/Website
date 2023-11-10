<html>

<body>
    <form method="post" action="">
        <input type="checkbox" name="chk1" value="en" <?php if (isset($_POST['chk1']) && $_POST['chk1'] == 'en')
            echo 'checked';
        else
            echo "" ?> />English <br>
            <input type="checkbox" name="chk2" value="vn" <?php if (isset($_POST['chk2']) && $_POST['chk2'] == 'vn')
            echo 'checked';
        else
            echo "" ?> />Vietnam<br>

            <input type="submit" value="submit"><br>
        </form>

        <?php
        if (isset($_POST['chk1']))
            echo "checkbox 1 : " . $_POST['chk1'] . "<br>";
        if (isset($_POST['chk2']))
            echo "checkbox 2 : " . $_POST['chk2'];

        ?>
    <hr>
    <hr>

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

    <hr>
    <hr>


    <form action="" name="myform" method="post">

        Your Name: <input type="test" name="Name" size=20 value="<?php if (isset($_POST['Name']))
            echo $_POST['Name']; ?>" />

        <br>

        <input type="submit" value="Submit">

    </form>

    <?php

    if (isset($_POST["Name"]))

        print "Hello " . $_POST["Name"];

    ?>

    <hr>
    <hr>

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
    <hr>
    <hr>
    <form action="" name="myform" method="post">
        First Name: <input type="text" name="Name[]" size=20 value="<?php if (isset($_POST['Name']))
            echo $_POST['Name'][0]; ?>" /><br>
        Last Name: <input type="text" name="Name[]" size=20 value="<?php if (isset($_POST['Name']))
            echo $_POST['Name'][1]; ?>" /><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['Name'])) {
        echo "Chào bạn " . $_POST['Name'][0] . " " . $_POST['Name'][1];
    }
    ?>
    <hr>
    <hr>
    <form action="" name="myform" method="post">
        <input type="radio" name="radGT" value="Nam" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nam')
            echo 'checked="checked"'; ?> checked /> Nam<br>
        <input type="radio" name="radGT" value="Nu" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nu')
            echo 'checked="checked"'; ?> />
        N&#7919;<br>

        <input type="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['radGT'])) {
        echo "Gioi tinh : " . $_POST['radGT'];
    }
    ?>
    <hr>
    <hr>

    <form action="textarea.php" name="myform" method="post">

        Your comment:

        <br>

        <textarea name="comment" rows="3" cols="40"><?php if (isset($_POST['comment']))
            echo $_POST['comment']; ?></textarea>

        <br>

        <input type="submit" value="Submit">

    </form>

    <?php

    if (isset($_POST["comment"]))

        print "Your comment: " . $_POST["comment"];

    ?>

</body>

</html>