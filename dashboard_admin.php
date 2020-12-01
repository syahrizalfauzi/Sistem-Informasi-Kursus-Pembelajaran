<?php
    session_start();
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] != 'admin')
            header('Location: dashboard.php');
    }else{
        header('Location: index.php');
    }
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Dashboard - SIRO</title>
</head>

<body class="d-flex h-100 flex-column">
    <header>
        <div class="navbar navbar-dark bg-dark">
            <h2 class="h2 navbar-brand">Sistem Informasi Rizal Operations</h2>
            <ul class="nav justify-content-end nav-pills">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </header>

    <main class="h-100">
        <div class="jumbotron">
            <h1>Selamat Datang!</h1>
            <h2 class="display-4">Administrator</h2>
        </div>
        <div class="container d-flex flex-column">
            <a href="jadwal.php" class="mb-4 bg-white border border-primary rounded p-4 align-items-center justify-content-between d-flex flex-row">
                <div class="flex-column">
                    <h3>Lihat Jadwal</h3>
                    <h6 class="text-muted">Lihat semua jadwal yang tersedia di Rizal Operations</h6>
                </div>
                <img src="./assets/jadwal.png" width="64" height="64">
            </a>
            <a href="peserta.php" class="mb-4 bg-white border border-primary rounded p-4 align-items-center justify-content-between d-flex flex-row">
                <div class="flex-column">
                    <h3>Lihat Daftar Peserta</h3>
                    <h6 class="text-muted">Lihat semua peserta yang terdaftar di Rizal Operations</h6>
                </div>
                <img src="./assets/peserta.png" width="64" height="64">
            </a>
            <a href="waktu.php" class="mb-4 bg-white border border-primary rounded p-4 align-items-center justify-content-between d-flex flex-row">
                <div class="flex-column">
                    <h3>Lihat Daftar Waktu</h3>
                    <h6 class="text-muted">Lihat semua waktu untuk jadwal di Rizal Operations</h6>
                </div>
                <img src="./assets/waktu.png" width="64" height="64">
            </a>
        </div>
    </main>

    <footer class="footer bg-dark text-light p-3">
        <div class="container">
            <p>
                Dibuat oleh Muhammad Syahrizal Fauzi sebagai Tugas Akhir Praktikum Sistem Basis Data
            </p>
            <p>
                Universitas Diponegoro, Fakultas Teknik, Teknik Komputer
            </p>
            <p class="text-muted">November 2020</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>