<?php
    include_once("config.php");

    $idWaktu = $_GET['id'];

    $result = mysqli_query($mysqli, "DELETE FROM waktu WHERE idWaktu=".$idWaktu);

    header("Location:waktu.php");
?>
