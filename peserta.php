<?php
    session_start();
    if($_SESSION['username'] != 'admin')
        header('Location: index.php');
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Peserta - SIRO</title>
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
                    <a class="nav-link active" href="peserta.php">Peserta</a>
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
    <p class="display-4">Daftar Peserta</p>
    <p>Berikut adalah peserta lengkap yang terdaftar pada Rizal Operations</p>
    <form action="peserta.php" method="post">
        <label for="searchBox">Cari peserta</label>
        <div class="flex-row d-flex">
            <input type="text" name="search" class="form-control" id="searchBox">
            <input type="submit" name="goSearch" value="Cari" class="btn btn-primary ml-4"> 
        </div>
    </form>

    <?php
        if(isset($_POST['goSearch'])){
            $search = $_POST['search'];
            echo "<p>Hasil pencarian peserta dengan nama '".$search."'</p>";
        }
    ?>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>No</th> 
            <th>Username</th> 
            <th>Nama</th> 
            <th>Aksi</th>
        </tr>
        </thead>
        <?php  
            include_once("config.php");

            if(isset($_POST['goSearch'])){
                $search = $_POST['search'];
                $result = mysqli_query($mysqli, "SELECT username, nama FROM akun WHERE nama LIKE '%".$search."%' OR username LIKE '%".$search."%' AND username <> 'admin'");
            }
            else{
                $result = mysqli_query($mysqli, "SELECT username, nama FROM akun WHERE username <> 'admin'");
            }

            if(mysqli_num_rows($result) == 0){
                echo "<tr>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
            }

            $no = 1;
            while($dataPeserta = mysqli_fetch_array($result)) {         
                echo "<tr>";
                echo "<td class='align-middle'>".$no."</td>";
                echo "<td class='align-middle'>".$dataPeserta['username']."</td>";
                echo "<td class='align-middle'>".$dataPeserta['nama']."</td>";
                echo "<td class='align-middle'><a href='peserta_detail.php?id=$dataPeserta[username]&nama=$dataPeserta[nama]' class='btn btn-primary btn-block'>Detail</a>";        
                $no++;
            }

            echo "<tr>";
            echo "<td class='align-middle' colspan='3'></td>";
            echo "<td class='align-middle'><a href='peserta_add.php' class='btn btn-primary btn-block'>Daftarkan peserta</td></tr>";  
        ?>
    </table>
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