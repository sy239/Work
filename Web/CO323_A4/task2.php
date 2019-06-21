<!--Task 2: Display an unordered list of club names and the total number of teams in each club, excluding clubs with <2 teams.-->

<title>Task 2</title>

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
"SELECT name, total
FROM club
JOIN (SELECT clubID, COUNT(clubID) AS 'total' FROM team GROUP BY clubID) t
ON cid = clubID
WHERE total >= 2;";

$query = $dbhandle->prepare($sql);

if($query->execute() === FALSE) {
   die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
}
?>

<ul>
   <?php while($row = $query->fetch()) { ?>
      <li>
         Club name: <?php echo $row['name']; ?><br/>
         Teams: <?php echo $row['total']; ?>
      </li>
   <?php } ?>
</ul>