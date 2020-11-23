<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Daftar Mata Pelajaran</h1>
    <form action="mapel.php" method="post">
        Cari mata pelajaran : <input type="text" name="search"> <input type="submit" name="goSearch" value="GO"> 
    </form>

    <?php
        if(isset($_POST['goSearch'])){
            $search = $_POST['search'];
            echo "Hasil pencarian mata pelajaran dengan nama '".$search."'";
        }
    ?>

    <table border=1>
        <tr>
            <th>ID</th> <th>Nama</th>
        </tr>
        <?php  
            include_once("config.php");

            if(isset($_POST['goSearch'])){
                $search = $_POST['search'];
                $result = mysqli_query($mysqli, "SELECT * FROM mapel WHERE namaMapel LIKE '%".$search."%'");
            }
            else{
                $result = mysqli_query($mysqli, "SELECT * FROM mapel");
            }

            while($dataMapel = mysqli_fetch_array($result)) {         
                echo "<tr>";
                echo "<td>".$dataJadwal['idMapel']."</td>";
                echo "<td>".$dataJadwal['namaMapel']."</td>";
                echo "<td>".$dataJadwal['hari']."</td>";
                echo "<td>".$dataJadwal['jam']."</td>";
                // echo "<td><a href='peserta_detail.php?id=$dataPeserta[username]&nama=$dataPeserta[nama]'>Detail</a>";        
            }

            // echo "<tr>";
            // echo '<td colspan="2"></td>';
            // echo "<td><a href='peserta_add.php'>Daftarkan peserta</td></tr>";  
        ?>
    </table>
</body>
</html>