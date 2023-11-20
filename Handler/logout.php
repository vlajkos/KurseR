<?php
session_start();

// Check if the "logout" button was clicked
if (isset($_POST['logout'])) {
    session_destroy();
    $_SESSION = array();



    header('Location: ../index.php');
    exit();
} else {

    header('Location: ../index.php');
    exit();
}
?>