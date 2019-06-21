<!--Task 1: Display a table with forenames, surnames, and dob of all members in club 'C02', ordered by gender then surname with the same gender.-->

<title>Task 1</title>
<style>
   table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
   }
</style>

<?php
//Start a session. If the user is not logged in, redirect them to the login page (loginform.html).
session_start();
if(!isset($_SESSION['loggedin'])) {
   session_destroy();
   header("Location: loginform.html");
}

//Connect to the database. If it fails, throw an exception.
try {
   $dbhandle = new PDO('mysql:host=dragon.kent.ac.uk; dbname=co323', 'co323', 'pa33word');
} catch (PDOException $e) {
   die('Error connecting to the database: ' . $e->getMessage());
}

//Run the SQL query. If it fails, print an error message.
$sql = 
"SELECT forename, surname, dob
FROM member
WHERE clubID = 'C02'
ORDER BY gender ASC, surname ASC";

$query = $dbhandle->prepare($sql);

if($query->execute() === FALSE) {
   die('Error running query: ' . implode($query->errorInfo(),' ')); 
}
?>

<table>
   <tr>
      <th>Forename</th>
      <th>Surname</th>
      <th>Date of birth</th>
   </tr>
   <?php while($row = $query->fetch()) { ?>
      <tr>
         <td><?php echo $row['forename']; ?></td>
         <td><?php echo $row['surname']; ?></td>
         <td><?php echo $row['dob']; ?></td>
      </tr>
   <?php } ?>
</table>