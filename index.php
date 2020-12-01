<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Sistem Informasi Rizal Operations</title>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <div class="navbar navbar-dark bg-dark">
            <h2 class="h2 navbar-brand">Sistem Informasi Rizal Operations</h2>
        </div>
    </header>
    <main class="h-100 align-items-center d-flex bg-secondary">
        <div class="container justify-content-center d-flex">
            <div class="bg-white border rounded p-4">
                <form action="login.php" method="post" class="form-group">
                    <h1 class="h3 mb-3">Log In</h1>
                    <p class="text-muted">Silahkan masuk dengan username dan password anda</p>
                    <label for="username">User Name</label>
                    <input type="text" name="username" id="username" class="form-control">
                    <label for="password" class="mt-2">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <input type="submit" name="login" value="Log in" class="btn btn-primary float-right mt-3">
                    <?php
                        if(isset($_GET['gagal'])){
                            $gagal = $_GET['gagal'];
                
                            if($gagal == true)
                                echo "<p class='text-danger'>Username atau password salah</p>";
                        }
                    ?>
                </form>
            </div>
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
    <?php
        session_start();
        if(isset($_SESSION['username'])){
            if($_SESSION['username'] == 'admin')
                header('Location: dashboard_admin.php');
            else
                header('Location: dashboard.php');
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

