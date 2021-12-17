<?php 

session_start();

$username = $_POST["username"];
$password = $_POST["password"];

if($username == "Admin" && $password == "Admin"){
    $_SESSION["logged_in"] = "TRUE";
    header("Location: /index.php");
    exit;
}else{
    echo "<span class='form_error' style='color:red'>Unvalid username or password</span>";
}

?>