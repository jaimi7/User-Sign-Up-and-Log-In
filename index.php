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
    <title>User Registration</title>
    <?php
        include 'db.php';
    ?>
</head>

<body>
    <div class="container">
        <p class="top">Create Account</p>
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
            <div class="input-field"><i class="fas fa-user"></i><input type="text" name="uname" placeholder="Full name"
                    required></div>
            <div class="input-field"><i class="fas fa-envelope"></i><input type="email" name="uemail"
                    placeholder="Email address" required></div>
            <div class="input-field"><i class="fas fa-phone-alt"></i><input type="text" name="uphone"
                    placeholder="Phone number" required></div>
            <div class="input-field"><i class="fas fa-unlock"></i><input type="password" name="upassword"
                    placeholder="Create password" required></div>
            <div class="input-field"><i class="fas fa-lock"></i><input type="password" name="ucpassword"
                    placeholder="Repeat password" required></div>
            <input type="submit" name="submit" id="submit" value="Create Account">
        </form>
        <p>Have an account ? <a href="login.php">Log In</a></p>
    </div>
</body>

</html>

<?php
    if(isset($_POST['submit'])){
        $uname=mysqli_real_escape_string($con,$_POST['uname']);
        $uemail=mysqli_real_escape_string($con,$_POST['uemail']);
        $uphone=mysqli_real_escape_string($con,$_POST['uphone']);
        $password=mysqli_real_escape_string($con,$_POST['upassword']);
        $cpassword=mysqli_real_escape_string($con,$_POST['ucpassword']);
        // mysqli_real_escape_string : used to make data safe before sending a query to MYSQL

        // Password Encryption
        // $upassword=password_hash($password,PASSWORD_BCRYPT);
        // $ucpassword=password_hash($cpassword,PASSWORD_BCRYPT);
        $upassword=md5($password);
        $ucpassword=md5($cpassword);

        // Email Validation
        $emailquery="SELECT * FROM tbl_user WHERE uemail='$uemail'";
        $equery=mysqli_query($con,$emailquery);
        $ecount=mysqli_num_rows($equery);

        if($ecount>0){
            ?>
                <script>
                    alert("Already existing email.");
                </script>
            <?php
        }
        else{
            // Check password and confirm password both are same.
            if($upassword===$ucpassword){
                // insert data into database
                $iquery="INSERT INTO tbl_user (uname, uemail, uphone, upassword, ucpassword) VALUES ('$uname', '$uemail', '$uphone', '$upassword', '$ucpassword')";
                $query=mysqli_query($con,$iquery);
                if($query){
                    ?>
                        <script>
                            alert("Account Created");
                        </script>
                    <?php
                }
                else{
                    ?>
                        <script>
                            alert("Error in Creating Account !");
                        </script>
                    <?php
                }
            }
            else{
                ?>
                    <script>
                        alert("Password and confirm password both are not same.");
                    </script>
                <?php
            }
        }
    }
?>