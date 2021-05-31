<?php
$name=$pwd="";
$db_server='localhost';
$db_username='root';
$db_password='';
$db_name='iccassn2';

$con=mysqli_connect($db_server, $db_username, $db_password,$db_name);
if($con===false){
    die("ERROR: Could not connect. " .mysqli_connect_error());

}

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $name=test_input($_POST["uname"]);
    $pwd=test_input($_POST["pwd"]);
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (($name != "") && ($pwd != "")) {
    $sql = "SELECT * from intern where Username = '$name' and 'Password' = '$pwd'";  
           $result = mysqli_query($con, $sql);  
           $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
           $count = mysqli_num_rows($result);  
             
           if($count == 1){    
               session_start();
               $_SESSION["name"]=$name;
               header("location: Welcome.php");
           }  
           else{  
               echo "<h1> Login failed. Invalid username or password.</h1>";  
           }     }
   ?>
