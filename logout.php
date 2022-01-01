<?php
    session_start();
    session_destroy();
    ?>
        <script>
            alert("You are Loged Out .");
        </script>  
    <?php 
    header('location:login.php');
?>
