<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/style.css">
    <title>User Log In</title>
    <?php
        include 'db.php'
    ?>
</head>

<body>
    <div class="container">
        <p class="top">Log In Account</p>
        <p>Get started with your free account</p>
        <div class="btn">
            <button id="gbtn"><i class="fab fa-google"></i>Login via Gmail</button>
            <button id="fbtn"><i class="fab fa-facebook-f"></i>Login via facebook</button>
        </div>
        <div class="line">
            <hr>
            <p>OR</p>
            <hr>
        </div>
        <form class="field" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="input-field"><i class="fas fa-envelope"></i><input type="email" name="uemail" id=""
                    placeholder="Email address"></div>
            <div class="input-field"><i class="fas fa-unlock"></i><input type="password" name="upassword" id=""
                    placeholder="Password"></div>
            <input type="submit" name="submit" id="submit" value="Log In Now">
        </form>
        <p>Don't Have an account ? <a href="index.php">Sign Up</a></p>
    </div>
</body>

</html>

<?php
    if(isset($_POST['submit'])){
        $uemail=mysqli_real_escape_string($con,$_POST['uemail']);
        $password=mysqli_real_escape_string($con,$_POST['upassword']);

        // $upassword=password_hash('$password',PASSWORD_BCRYPT);
        $upassword=md5($password);
        
        $esearch="SELECT * FROM tbl_user WHERE uemail='$uemail'";
        $equery=mysqli_query($con,$esearch);
        $ecount=mysqli_num_rows($equery);

        if($ecount){
            $epass=mysqli_fetch_assoc($equery);
            $pass=$epass['upassword'];
            
            $_SESSION['uname']=$epass['uname'];
            
            // $decode=password_verify($password,$pass);

            // if($decode){
            if($upassword===$pass){
                ?>
                    <script>
                        alert("Log In successfully .");
                    </script>
                <?php
                // header('location:home.php');
                ?>
                    <script>
                        location.replace("home.php");
                    </script>
                <?php
            }
            else{
                ?>
                    <script>
                        alert("Incorrect Password !");
                    </script>
                <?php
            }
        }
        else{
            ?>
                <script>
                    alert("Invalide User !");
                </script>
            <?php
        }
    }
?>