<?php
    include_once("config.php");
    $idWaktu = $_GET['id'];

    $result = mysqli_query($mysqli, "SELECT * FROM waktu WHERE idWaktu=".$idWaktu);

    while($dataWaktu = mysqli_fetch_array($result))
    {
        $hari = $dataWaktu['hari'];
        $jam = $dataWaktu['jam'];
    }
?>
<html>
<head>  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Ubah Waktu - SIRO</title>
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
    <p class="display-4">Perubahan Waktu</p>
    <p>Silahkan isi form berikut untuk mengubah jam untuk jadwal</p>

    <form action="waktu_edit.php?id=<?php echo $idWaktu ?>" method="post" class="form-group">
        <label for="hari">Hari</label>
        <input type="text" name="hari" id="hari" class="form-control" value="<?php echo $hari;?>">
        <label for="jam">Jam</label>
        <input type="time" name="jam" id="jam" class="form-control" value="<?php echo $jam;?>">
        <input type="hidden" name="idWaktu" value=<?php echo $_GET['id'];?>>
        <input type="submit" name="submit" value="Ubah" class="btn btn-primary float-right mt-3">
    </form>
    <?php
        include_once("config.php");
        if(isset($_POST['submit'])) {
            $idWaktu = $_POST['idWaktu'];
            $hari=$_POST['hari'];
            $jam=$_POST['jam'];
            $result = mysqli_query($mysqli, "SELECT hari, jam FROM waktu WHERE hari='".$hari."' AND jam='".$jam."'");

            if(mysqli_num_rows($result) != 0){
                echo "<p class='text-danger'>Waktu sudah ada.</p>";
            }
            else{
                $result = mysqli_query($mysqli, "UPDATE waktu SET hari='".$hari."',jam='".$jam."' WHERE idWaktu=".$idWaktu);
                header("Location: waktu.php");
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
