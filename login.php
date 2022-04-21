<?php
    include 'koneksi.php';
    session_start();

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' && password = '$password'");
        if ($query -> num_rows > 0) {
            $row = mysqli_fetch_assoc($query);
            $_SESSION['username'] = $row['username'];
            echo"<script>alert('Login berhasil')</script>";
            header("location:index.php");
        }else{
            echo"<script>alert('Periksa kembali username dan password !!')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 py-5">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h2 class="text-center">LOGIN</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div>
                                <label>USERNAME</label>
                                <input type="text" name="username" placeholder="MASUKAN USERNAME" class="form-control" required>
                            </div>
                            <div>
                                <label>PASSWORD</label>
                                <input type="password" name="password" placeholder="MASUKAN PASSWORD" class="form-control" required>
                            </div>
                            <div>
                                <input type="submit" name="submit" value="LOGIN" class="btn btn-primary col-sm-12 mt-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>