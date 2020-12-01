<?php

    include_once("config.php");

    session_start();
    $idMapel = $_POST['idMapel'];
    $idPeserta = $_SESSION['username'];

    if(isset($_POST['add']))
        $result = mysqli_query($mysqli, "INSERT INTO peserta (idPeserta,idMapel) VALUES('".$idPeserta."','".$idMapel."')");

    if(isset($_GET['jadwal']))
        header("Location:jadwal.php");
    else
        header("Location:dashboard.php");
?>
