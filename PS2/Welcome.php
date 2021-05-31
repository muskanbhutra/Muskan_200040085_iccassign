<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Internships Available</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($_SESSION["name"]); ?></h1>
</body>
</html>
