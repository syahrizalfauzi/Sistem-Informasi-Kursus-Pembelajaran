<?php  
    include_once("config.php");
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($mysqli, "SELECT accessToken, nama FROM akun WHERE accessToken=MD5('".$username."|".$password."')");

    //Gada user
    if(mysqli_num_rows($result) == 0){
        header('Location: index.php?gagal=true');
    }
    //Ada user, login
    else{
        while($user_data = mysqli_fetch_array($result)) {    
            $_SESSION['username'] = $username;     
            $_SESSION['nama'] = $user_data['nama'];
            if($username == 'admin')
                header('Location: dashboard_admin.php');
            else
            header('Location: dashboard.php');
        }
    }
?>