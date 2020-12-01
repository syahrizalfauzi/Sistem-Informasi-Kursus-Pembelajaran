<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Jadwal - SIRO</title>
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
                    <a class="nav-link active" href="jadwal.php">Jadwal</a>
                </li>
                <?php
                    session_start();
                    if($_SESSION['username'] == 'admin')
                    {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link text-white" href="peserta.php">Peserta</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link text-white" href="waktu.php">Waktu</a>';
                        echo '</li>';
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </header>

    <main class="h-100 d-flex flex-column container mt-3">
    <p class="display-4">Daftar Jadwal</p>
    <p>Berikut adalah jadwal lengkap yang tersedia pada Rizal Operations</p>
    <form action="jadwal.php" method="post">
        <label for="searchBox">Cari jadwal</label>
        <div class="flex-row d-flex">
            <input type="text" name="search" class="form-control" id="searchBox">
            <input type="submit" name="goSearch" value="Cari" class="btn btn-primary ml-4"> 
        </div>
    </form>

    <?php
        if(isset($_POST['goSearch'])){
            $search = $_POST['search'];
            echo "<p>Hasil pencarian mata pelajaran dengan nama '".$search."'</p>";
        }
    ?>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <?php if($_SESSION['username'] == 'admin') echo '<th>ID Mapel</th>'?> 
            <?php if($_SESSION['username'] != 'admin') echo '<th>No</th>'?> 
            <th>Nama</th> 
            <th>Kelas</th>  
            <th>Hari</th> 
            <th>Jam</th> 
            <?php if($_SESSION['username'] == 'admin') echo '<th colspan="2">Aksi</th>'?> 
            <?php if($_SESSION['username'] != 'admin') echo '<th>Aksi</th>'?>
        </tr>
        </thead>
        <?php  
            include_once("config.php");
            
            $username = $_SESSION['username'];

            if(isset($_POST['goSearch'])){
                $search = $_POST['search'];
                $result = mysqli_query($mysqli, "SELECT * FROM jadwal WHERE namaMapel LIKE '%".$search."%' OR kelas LIKE '%".$search."%' OR hari LIKE '%".$search."' OR jam LIKE '%".$search."%'");
            }
            else{
                $result = mysqli_query($mysqli, "SELECT * FROM jadwal");
            }
            

            if(mysqli_num_rows($result) == 0){
                echo "<tr>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
                echo "<td class='align-middle'>-</td>";
                if($username == 'admin'){
                    echo "<td class='align-middle'>-</td>";
                    echo "<td class='align-middle'>-</td>";
                }
            }

            if($username != 'admin'){
                $resultt = mysqli_query($mysqli, "SELECT idMapel FROM peserta WHERE idPeserta = '".$username."'");
                $idMapelAmbil = array();
                while($jadwalAmbil = mysqli_fetch_array($resultt)){
                    array_push($idMapelAmbil, $jadwalAmbil['idMapel']);
                }
            }

            $no = 1;
            while($dataJadwal = mysqli_fetch_array($result)) {       
                $terambil = false;  
                echo "<tr>";
                if($username != 'admin')
                    echo "<td class='align-middle'>".$no."</td>";
                else
                    echo "<td class='align-middle'>".$dataJadwal['idMapel']."</td>";
                echo "<td class='align-middle'>".$dataJadwal['namaMapel']."</td>";
                echo "<td class='align-middle'>".$dataJadwal['kelas']."</td>";
                echo "<td class='align-middle'>".$dataJadwal['hari']."</td>";
                echo "<td class='align-middle'>".$dataJadwal['jam']."</td>";
                if($username != 'admin'){
                    foreach($idMapelAmbil as $key => $value){
                        if($value == $dataJadwal['idMapel']){
                            echo "<td class='text-center'>Terambil</td>";
                            $terambil = true;
                            break;
                        }
                    }
                    if($terambil == false){
                        echo '<form action="jadwalpeserta_add.php?jadwal=true.php" method="post">';
                        echo '<td><input type="hidden" name="idMapel" value='.$dataJadwal["idMapel"].'>';
                        echo '<input type="submit" name="add" value="Ambil" class="btn btn-block btn-primary"></td>';
                        echo '</form>';
                    }
                }
                else{
                    echo "<td><a href='jadwal_edit.php?id=$dataJadwal[idMapel]' class='btn btn-info btn-block'>Ubah</a></td>";
                    echo "<td><a href='jadwal_delete.php?id=$dataJadwal[idMapel]' class='btn btn-danger btn-block'>Hapus</a></td></tr>";  
                }
                $no++;        
            }
            
            if($_SESSION['username'] == 'admin'){
                echo "<tr>";
                echo '<td colspan="5"></td>';
                echo '<td colspan="2"><a href="jadwal_add.php" class="btn btn-primary btn-block">Tambah Jadwal</td></tr>';  
            }
            
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