<?php
    session_start();
    $username = $_SESSION['username'];
    $nama = $_SESSION['nama'];
?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Profil</h1>

    <h2>Update data akun</h2>
    <form name="update_akun" method="post" action="profil.php">
        <table border="0">
            <tr> 
                <td>Username</td>
                <td><input type="text" name="username" value=<?php echo $username;?>></td>
            </tr>
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama" value=<?php echo $nama;?>></td>
            </tr>
            <tr> 
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>

    <?php
        if(isset($_POST['update_akun'])){

            $password = $_POST['password'];

            $newUsername = $_POST['username'];
            $newNama = $_POST['nama'];

            if($newUsername != $username && $newNama != $nama)
            {
                $result = mysqli_query($mysqli, "UPDATE akun SET username = '$newUsername', nama = '$newNama', accessToken = MD5('$username|$password') WHERE accessToken = MD5('$newUsername|$password')");
            }
            else if($newUsername != $username && $newNama == $nama)
            {
                $result = mysqli_query($mysqli, "UPDATE akun SET username = '$newUsername', accessToken = MD5('$username|$password') WHERE accessToken = MD5('$newUsername|$password')");
            }
            else if($newUsername == $username && $newNama != $nama)
            {
                $result = mysqli_query($mysqli, "UPDATE akun SET nama = '$newNama' WHERE accessToken = MD5('$username|$password')");
            }
            if(mysqli_affected_rows($result) == 1)
                echo "Data berhasil di-update";
        }
    ?>
</body>

</html>