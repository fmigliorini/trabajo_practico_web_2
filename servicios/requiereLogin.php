<?php

session_start();
if ( !isset( $_SESSION['authenticate'] ) || $_SESSION['authenticate'] !== true ){
    // echo "LOGIN";
    header('Location: login.php');
    exit;
}else{
    // echo "ALL GOOD";
}
    // Go to login

// next();
