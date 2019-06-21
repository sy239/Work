<!--Task 3: Retrieve the details of each team (tid, category, division, clubID, venue). Display an HTML form with a drop-down list input and submit button. The drop-down list should contain the results retrieved; when a user selects a specific team the team ID (tid) is submitted via the GET method from task4.php.-->

<title>Task 3</title>

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
"SELECT tid, category, division, clubID, venue
FROM team
JOIN club
ON clubID = cid";

$query = $dbhandle->prepare($sql);

if($query->execute() === FALSE) {
   die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
}

$results = $query->fetchAll();
?>

<form action="task4.php" method="GET">
   <select name="teamID">
      <?php foreach($results as $row) { ?>
         <option value=<?php echo $row['tid']?>>
            <?php echo $row['tid']?>
         </option>
      <?php } ?>
   </select>
   <input type="submit" value="Submit"/>
</form>