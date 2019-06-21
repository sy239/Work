<!--Task 4: Accept the team ID (tid) submitted from task3.php and display the details of all the matches played by the team. Use a parameterised query to prevent SQL injection.-->

<title>Task 4</title>
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
"SELECT *
FROM fixture 
WHERE homeTeam = :input";

//Get the requested team ID.
$tid = $_GET['teamID'];

$query = $dbhandle->prepare($sql);
$params = array(":input" => $tid);

if($query->execute($params) === FALSE) {
   die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
}

$results = $query->fetchAll();
?>

<table>
   <tr>
      <th>Home team</th>
      <th>Away team</th>
      <th>Date of match</th>
      <th>Home team's score</th>
      <th>Away team's score</th>
   </tr>
   <?php foreach($results as $row) { ?>
      <tr>
         <td><?php echo $row['homeTeam']; ?></td>
         <td><?php echo $row['awayTeam']; ?></td>
         <td><?php echo $row['onDate']; ?></td>
         <td><?php echo $row['homeTeamScore']; ?></td>
         <td><?php echo $row['awayTeamScore']; ?></td>
      </tr>
   <?php } ?>
</table>