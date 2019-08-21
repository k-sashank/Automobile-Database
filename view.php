<?php

require_once "pdo.php";

session_start();

if ( ! isset($_SESSION['name']) ) {
  
die('Not logged in');
}
  
?>

<html>

<head>
<title>Madipally Sai Krishna Sashank</title>
</head>
<body>

<h1><?php echo("Tracking autos for ".$_SESSION['name']);?></h1>
<?php
if ( isset($_SESSION['error']) ) {
    
echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    
unset($_SESSION['error']);
}

if ( isset($_SESSION['success']) ) {
    
echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    
unset($_SESSION['success']);
}
?>
<h2> Automobiles</h2>
<?php
echo('<table border="1">'."\n");

$stmt = $pdo->query("SELECT autos_id, make, model, year, mileage FROM autos");

while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    
echo "<tr><td>";
    
echo(htmlentities($row['make']));
    
echo("</td><td>");   
echo(htmlentities($row['year']));
    
echo("</td><td>");
   
echo(htmlentities($row['mileage']));
    
echo("</td></tr>\n");
}
?>

</table>
<a href="add.php">Add New</a>
<a href="logout.php">Logout</a>
</body>

</html>