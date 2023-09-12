<?php 
    session_start();

    session_destroy();
    header('location: sign-inv2.php');
?>