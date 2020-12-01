<?php

    include_once("config.php");

    session_start();
    $id = $_GET['id'];

    $result = mysqli_query($mysqli, "DELETE FROM peserta WHERE id=".$id);

    header("Location:dashboard.php");
?>
