<!--Task 5a: Create a PHP script file named menu.php containing links to all pages.-->

<title>Task 5a</title>

<?php
session_start();
if(!isset($_SESSION['loggedin'])) {
   session_destroy();
   header("Location: loginform.html");
}
?>

<a href="task1.php">Task 1</a>
<a href="task2.php">Task 2</a>
<a href="task3.php">Task 3</a>
<a href="task4.php">Task 4</a>