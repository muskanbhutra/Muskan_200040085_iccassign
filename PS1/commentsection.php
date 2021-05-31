<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
<meta charset="UTF-8">
<style>
* {
    box-sizing: border-box;
}
html {
    background: linear-gradient(to bottom, black, white) no-repeat center fixed;
    background-size: cover;
}
input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    font-size: 15px;
}
.name {
    width: 25%;
    margin: 8px auto;
}
.commentsection {
    width: 25%;
    margin: 8px auto;
}
#botttom {
    margin: 8px 0 0 0;
}
</style>
</head>
<body>
<?php
$name=$comment="";
$nameerr="";
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="name">
<input type="text" name="fname" placeholder="FULL NAME">
<p class="error">* <?php echo $nameerr;?></p>
</div>
<div class="commentsection">
<input type="text" name="comment" id="bottom" placeholder="Type your comment here">
<input type="submit" value="Post">
</div>
</form>
<?php
$db_server='localhost';
$db_username='root';
$db_password='';
$db_name='ICCassn';
$conn=new mysqli($db_server,$db_username,$db_password,$db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT Username, Comment FROM Comments";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
    while($row=$result->fetch_assoc()) {
    echo "<div class='commentsection'>
          <p><strong>" . $row["Username"]. "</strong></p>
          <p>" . $row["Comment"]. "</p>
          </div>";
    }
}else {echo "";}


if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (empty($_POST["fname"])) {
        $nameerr="Name is required";
    } else {
        $name=test_input($_POST['fname']);
    }
    $comment=test_input($_POST['comment']);
}
function test_input($data) {
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
if (($name !="")&&($comment !="")) {
    $sql="INSERT INTO Comments
    VALUES ('$name', '$comment')";
    if ($conn->query($sql)===TRUE) {
        echo "<div class='commentsection'>
        <p><strong>" . $name. "</strong></p>
        <p>" . $comment. "</p>
        </div>";
   
    } else {
        echo "Error: " . $sql. $conn->error;
    }
    $conn->close();
}
?>

</body>
</html>
