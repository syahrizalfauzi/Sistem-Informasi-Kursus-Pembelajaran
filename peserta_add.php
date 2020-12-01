<?php
    $username = "";
    $password = "";
    $nama = "";

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
    }
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Tambah Jadwal - SIRO</title>
</head>

<body class="d-flex h-100 flex-column">
    <header>
        <div class="navbar navbar-dark bg-dark">
            <h2 class="h2 navbar-brand">Sistem Informasi Rizal Operations</h2>
            <ul class="nav justify-content-end nav-pills">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="jadwal.php">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="peserta.php">Peserta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="waktu.php">Waktu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </header>
    <main class="h-100 d-flex flex-column container mt-3">
    <p class="display-4">Penambahan Peserta</p>
    <p>Silahkan isi form berikut untuk mendaftarkan peserta baru</p>

    <form action="peserta_add.php" method="post" class="form-group">
        <label for="username">User Name</label>
        <input type="text" name="username" id="username" class="form-control" value="<?php echo $username;?>">
        <label for="nama" >Nama Lengkap</label>
        <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $nama;?>">
        <label for="password" >Kata Sandi</label>
        <input type="password" name="password" id="password" class="form-control" value="<?php echo $password;?>">
        <input type="submit" name="submit" value="Tambahkan" class="btn btn-primary float-right mt-3">
    </form>

    <?php

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];

        if(strlen($username) == 0 || strlen($password) == 0 || strlen($nama) == 0){
            echo "<p class='text-danger'>Mohon lengkapi form.</p>";
        }
        else{
            include_once("config.php");
            $result = mysqli_query($mysqli, "SELECT username FROM akun WHERE username='".$username."'");

            if(mysqli_num_rows($result) != 0){
                echo "<p class='text-danger'>Sudah ada peserta dengan username yang sama.</p>";
            }
            else{
                $result = mysqli_query($mysqli, "INSERT INTO akun(username,nama,accessToken) VALUES('".$username."','".$nama."', MD5('".$username."|".$password."'))");
                echo "<p class='text-success'>Peserta berhasil ditambah.</p>";
                echo "<a href='peserta.php'>Kembali</a>";
            }
        }
    }
    ?>
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