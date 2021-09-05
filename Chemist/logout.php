<?php
    session_start();
   // unset($_SESSION['module']);
    //unset($_SESSION['uname']);
    //unset($_SESSION['passw']);
    session_unset();
    session_destroy();
    header("Location: ../login.php");
?>