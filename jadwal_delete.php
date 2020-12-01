<?php
    include_once("config.php");

    $idMapel = $_GET['id'];

    $result = mysqli_query($mysqli, "DELETE FROM mapel WHERE idMapel=".$idMapel);

    header("Location:jadwal.php");
?>
