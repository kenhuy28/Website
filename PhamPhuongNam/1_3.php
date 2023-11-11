<?php
include '../templates/header.php';
?>
<form action="1_3.php" name="myform" method="post">

	Your comment: 

	<br>

	<textarea name="comment" rows="3" cols="40"><?php if(isset($_POST['comment'])) echo $_POST['comment']; ?></textarea>

	<br>

	<input type="submit" value="Submit">

</form>

<?php

	if (isset($_POST["comment"]))

		print "Your comment: " . $_POST["comment"];

?>

<?php include '../templates/footer.php' ?>