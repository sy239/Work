<!--Task 5d: If the user is logged in, destroy the session. Otherwise, redirect the user to loginform.html.-->

<title>Task 5d</title>

<?php
session_start();
if($_SESSION['loggedin'] == true) {
   session_destroy();
} else {
   header("Location: loginform.html");
}
?>