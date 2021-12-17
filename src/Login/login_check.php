<!-- This script cheeks if the admin is logged in -->
<?php 

session_start();

if(!isset($_SESSION["logged_in"])){
    header("Location: /Login/login_page.html");
    exit;
}

?>