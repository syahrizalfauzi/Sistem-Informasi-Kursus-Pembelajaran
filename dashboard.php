<?php  
    include_once("config.php");
    session_start();
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] == 'admin')
            header('Location: dashboard_admin.php');
    }else{
        header('Location: index.php');
    }
    $username = $_SESSION['username'];
    $nama = $_SESSION['nama'];
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
                    <a class="nav-link active" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="jadwal.php">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </header>

    <main class="h-100">
    <div class="jumbotron">
        <h2>Selamat Datang!</h2>
        <h1 class="display-4"><?php echo $nama ?></h1>
    </div>

    <div class="container d-flex flex-column">
    <h2>Jadwal Anda</h2>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>No</th> <th>Nama</th> <th>Kelas</th> <th>Hari</th> <th>Jam</th> <th>Aksi</th>
        </tr>
        </thead>
        <?php  
            include_once("config.php");

            $result = mysqli_query($mysqli, "SELECT  A.id, A.idMapel, B.namaMapel, B.kelas, B.hari, B.jam FROM peserta AS A INNER JOIN jadwal AS B ON A.idMapel = B.idMapel AND A.idPeserta = '".$username."'");

            if(mysqli_num_rows($result) == 0){
                echo "<tr>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
            }
            else{
                $no = 1;
                while($dataJadwal = mysqli_fetch_array($result)) {         
                    echo "<tr>";
                    echo "<td class='align-middle'>".$no."</td>";
                    echo "<td class='align-middle'>".$dataJadwal['namaMapel']."</td>";
                    echo "<td class='align-middle'>".$dataJadwal['kelas']."</td>";
                    echo "<td class='align-middle'>".$dataJadwal['hari']."</td>";
                    echo "<td class='align-middle'>".$dataJadwal['jam']."</td>";
                    echo "<td class='align-middle'><a href='jadwalpeserta_delete.php?id=$dataJadwal[id]' class='btn btn-danger btn-block'>Hapus</td>";
                    $no++;
                }
            }
            
            $result = mysqli_query($mysqli, "SELECT idMapel, namaMapel, kelas FROM mapel WHERE idMapel NOT IN (SELECT idMapel FROM peserta WHERE idPeserta = '$username')");
            if(mysqli_num_rows($result) != 0){
                echo '<form action="jadwalpeserta_add.php" method="post">';
                echo '<tr>';
                echo "<td colspan='2' class='align-middle'>Nama Mapel</td>";
                echo "<td colspan='3' class='align-middle'>";
                echo '<select name="idMapel" class="btn btn-info btn-block">';
                while($dataJadwal = mysqli_fetch_array($result)) {         
                    echo "<option value =".$dataJadwal['idMapel']."> ".$dataJadwal['namaMapel']." - ".$dataJadwal['kelas']."</option>";
                }
                echo '</select>';
                echo '</td>';
                echo '<td><input type="submit" name="add" value="Ambil" class="btn btn-primary btn-block"></td>';
                echo '</tr>';
                echo '</form>';
            }
        ?>
    </table>
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