<?php

require_once "pdo.php";

session_start();


if ( isset($_POST['make']) && isset($_POST['model'])
 && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['autos_id']) ) {

   
    
if ( strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1) {
       
$_SESSION['error'] = 'Missing data';
        
header("Location: edit.php?autos_id=".$_POST['autos_id']);
        return;
    }

 
$sql = "UPDATE autos SET make = :make,
 model = :model, year = :year, mileage = :mileage
 WHERE autos_id = :autos_id";
    
$stmt = $pdo->prepare($sql);
    
$stmt->execute(array(':make' => $_POST['make'],
 ':model' => $_POST['model'],
 ':year' => $_POST['year'],
 ':mileage' => $_POST['mileage'], ':autos_id' => $_POST['autos_id']));
    
$_SESSION['success'] = 'Record updated';
    
header( 'Location: welcome.php' ) ;
    return;
}


if ( ! isset($_GET['autos_id']) ) {
  
$_SESSION['error'] = "Missing autos_id";
  
header('Location: welcome.php');
  return;
}


$stmt = $pdo->prepare("SELECT * FROM autos where autos_id = :xyz");

$stmt->execute(array(":xyz" => $_GET['autos_id']));

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false ) {
    
$_SESSION['error'] = 'Bad value for autos_id';
    
header( 'Location: welcome.php' ) ;
    
return;
}


// Flash pattern

if ( isset($_SESSION['error']) ) {
    
echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    
unset($_SESSION['error']);
}


$n = htmlentities($row['make']);

$e = htmlentities($row['model']);

$p = htmlentities($row['year']);
$q = htmlentities($row['mileage']);

$autos_id = $row['autos_id'];
?>

<html>
<head><title>Madipally Sai Krishna Sashank</title></head>
<body>
<p>Edit User</p>

<form method="post">

<p>Make:
<input type="text" name="make" value="<?= $n ?>"></p>

<p>Model:
<input type="text" name="model" value="<?= $e ?>"></p>

<p>Year:
<input type="text" name="year" value="<?= $p ?>"></p>

<p>Mileage:
<input type="text" name="mileage" value="<?= $q ?>"></p>

<input type="hidden" name="autos_id" value="<?= $autos_id ?>">
<p>
<input type="submit" value="Save"/>
<a href="welcome.php">Cancel</a></p>

</form>

</body>
</html>