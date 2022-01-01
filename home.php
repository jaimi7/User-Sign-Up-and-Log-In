<?php
    session_start();

    if(!isset($_SESSION['uname'])){
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/home.css">
    <title>Welcome</title>
</head>
<body>
    <div class="container">
        <div class="menu">
            <a href="logout.php">Log Out</a>
        </div>
        <div class="main">
            <div class="text-container">
                <p>Hello,</p>
                <p><?php echo $_SESSION['uname']; ?></p>
                <p>Website & Application <br> Developer</p>
            </div>
            <img src="img/img.jpg" alt="Patel Jaimi" class="img">
        </div>
    </div>
</body>
</html> 