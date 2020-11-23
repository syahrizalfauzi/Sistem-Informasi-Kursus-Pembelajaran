<?php
    session_start();
    $_SESSION['username'] = '';
    $_SESSION['nama'] = '';
    unset($_SESSION['username']);
    unset($_SESSION['nama']);
    session_unset();
    session_destroy();
    header("Location: index.php");
?>