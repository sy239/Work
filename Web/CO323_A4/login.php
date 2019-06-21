<!--Task 5c: Get the parameters passed from loginform.html and check wheter the username is "a3" and the password is "testing". If both are correct, start a session, set loggedin to true, and redirect the user to menu.php. Otherwise, display a message and a linkback to loginform.html.-->

<title>Task 5c</title>

<?php
if($_POST['username'] == "a3" && $_POST['password'] == "testing") {
   session_start();
   $_SESSION['loggedin'] = true;
   header("Location: menu.php");
} else { ?>
	 <p>Wrong login info.</p>
	 <a href="loginform.html">Back to login page.</a>
<?php } ?>