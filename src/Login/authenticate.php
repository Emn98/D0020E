<?php 

session_start();

$username = $_POST["username"];
$password = $_POST["password"];

if($username == "Admin" && $password == "Admin"){
    $_SESSION["logged_in"] = "TRUE";
    echo 1;
}else{
    echo "<span class='form_error' style='color:red'>Invalid username or password</span>";
}

?>