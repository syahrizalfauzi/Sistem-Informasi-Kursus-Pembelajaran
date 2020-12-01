<?php
    include_once("config.php");
    $idMapel = $_GET['id'];

    $result = mysqli_query($mysqli, "SELECT * FROM mapel WHERE idMapel=".$idMapel);

    while($dataMapel = mysqli_fetch_array($result))
    {
        $namaMapel = $dataMapel['namaMapel'];
        $kelas = $dataMapel['kelas'];
        $idWaktu = $dataMapel['idWaktu'];
    }
?>
<html>
<head>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Ubah Jadwal - SIRO</title>
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
    <p class="display-4">Perubahan Jadwal</p>
    <p>Silahkan ubah form berikut untuk megubah jadwal mata pelajaran</p>

    <form action="jadwal_edit.php?id=<?php echo $idMapel;?>" method="post" class="form-group">
        <label for="namaMapel">Nama Mata Pelajaran</label>
        <input type="text" name="namaMapel" id="namaMapel" class="form-control" value="<?php echo $namaMapel;?>">
        <label for="kelas" >Kelas</label>
        <input type="text" name="kelas" id="kelas" class="form-control" value="<?php echo $kelas;?>">
        <label for="waktu" >Waktu</label>
        <select name="idWaktu" id="waktu" class="btn btn-outline-secondary btn-block" value="<?php echo $idWaktu;?>">
            <?php
                include_once("config.php");
                $result = mysqli_query($mysqli, "SELECT * FROM waktu");
                while($dataWaktu = mysqli_fetch_array($result)) {       
                    if($dataWaktu['idWaktu'] == $idWaktu)  
                        echo "<option selected='selected' value =".$dataWaktu['idWaktu']."> ".$dataWaktu['hari'].", ".$dataWaktu['jam']."</option>";
                    else
                        echo "<option value =".$dataWaktu['idWaktu']."> ".$dataWaktu['hari'].", ".$dataWaktu['jam']."</option>";
                }
            ?>
        </select>
        <input type="hidden" name="idMapel" value=<?php echo $idMapel;?>>
        <input type="submit" name="submit" value="Ubah" class="btn btn-primary float-right mt-3">
    </form>
    <?php
        if(isset($_POST['submit']))
        {   
            $namaMapel = $_POST['namaMapel'];
            $kelas = $_POST['kelas'];
            $idWaktu = $_POST['idWaktu'];
            $idMapel = $_POST['idMapel'];
            
            $result = mysqli_query($mysqli, "SELECT idWaktu, namaMapel, kelas FROM mapel WHERE kelas='".$kelas."' AND idWaktu='".$idWaktu."' AND namaMapel='".$namaMapel."'");

            if(mysqli_num_rows($result) != 0){
                echo "<p class='text-danger'>Sudah ada jadwal yang sama.</p>";
            }
            else{
                $result = mysqli_query($mysqli, "UPDATE mapel SET idWaktu='".$idWaktu."',namaMapel='".$namaMapel."',kelas='".$kelas."' WHERE idMapel=".$idMapel);
                header("Location: jadwal.php");
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
