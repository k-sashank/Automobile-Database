<?php
require_once "pdo.php";

session_start();



if ( isset($_POST['cancel'] ) ) {
    
    
header("Location: index.php");
    return;
}


$salt = 'XyZzy12*_';

$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
if ( isset($_POST['email']) && isset($_POST['pass']) ) {
if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
        
$_SESSION['error'] = "User name and password are required";
    } else {
if(!empty($_POST['email'])) {
	$email = trim(htmlspecialchars($_POST['email']));
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	if ($email === false) {
		$_SESSION['error']="Invalid Email( no '@' symbol)";
}
else{
$check = hash('md5', $salt.$_POST['pass']);
        
if ( $check == $stored_hash ) {
 
$_SESSION['success'] = "Login success ".$_POST['email'];           
   
$_SESSION['name'] = $_POST['email'];         
header("Location: view.php");            return;
        } 
else {
            
$_SESSION['error'] = "Login fail ".$_POST[email]." $check";
         }
    }
}}

}


?>

<!DOCTYPE html>

<html>

<head>

<?php require_once "bootstrap.php"; ?>

<title>Madipally Sai Krishna Sashank</title>

</head>

<body>

<div class="container">

<h1>Please Log In</h1>

<?php


if ( $_SESSION['error'] !== false ) {
    
    
echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
}
?>

<form method="POST">

<label for="nam">E-Mail</label>

<input type="text" name="email" id="nam"><br/>

<label for="id_1723">Password</label>

<input type="text" name="pass" id="id_1723"><br/>

<input type="submit" value="Log In">

<input type="submit" name="cancel" value="Cancel">
</form>
</div>

</body>
</html>