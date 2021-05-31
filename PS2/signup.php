<?php
$name=$pwd=$email="";
$db_server='localhost';
$db_username='root';
$db_password='';
$db_name='iccassn2';

$con=mysqli_connect($db_server, $db_username, $db_password,$db_name);
if($con===false){
    die("ERROR: Could not connect. " .mysqli_connect_error());

}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $name=test_input($_POST["fname"]);
    $pwd=test_input($_POST["pwd"]);
    $email=test_input($_POST["email"]);
}
function test_input($data) {
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (($name != "") && ($pwd != "") && ($email != "")) {
  $sql="INSERT INTO intern
  VALUES ('$name', '$pwd', '$email');";

  if (mysqli_query($con,$sql)) {
      echo "Registration successful";
      session_start();
              $_SESSION["name"]=$name;
              header("location: Welcome.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }

  mysqli_close($con);
}
  ?>