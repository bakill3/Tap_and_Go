<?php  
include '../ligar_db.php';
if (isset($_SESSION['login_dashboard'])) {
    header('Location: index.php');
    exit(0);
}

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
        $password = htmlspecialchars(mysqli_real_escape_string($link, $_POST['password']));

        $query = mysqli_query($link, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        if (mysqli_num_rows($query) > 0) {
            $info = mysqli_fetch_assoc($query);
            $id = $info['id'];
            $nome = $info['nome'];
            $apelido = $info['apelido'];
            $morada = $info['morada'];
            $cidade = $info['cidade'];
            $pais = $info['pais'];
            $id_local = $info['id_local'];
            $role = $info['role'];
            $username = $info['username'];

            if ($id_local != NULL) {
                $_SESSION['login_dashboard'] = array($id, $username, $nome, $apelido, $morada, $cidade, $pais, $id_local, $email, $role);
                header('Location: index.php');
                exit(0);
            } else {
                $_SESSION['erro_login_dashboard'] = "Establishment not assigned yet";
                header('Location: login.php');
                exit(0);
            }

        } else {
            $_SESSION['erro_login_dashboard'] = "Email or Password Invalid";
            header('Location: login.php');
            exit(0);
        }
    } else {
        $_SESSION['erro_login_dashboard'] = "Fill all the inputs";
        header('Location: login.php');
        exit(0);
    }
}
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tap&Go - Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo/favicon.ico">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex" style="padding-right: 0;">
                                <div class="flex-grow-1 bg-login-image" style="background: url(&quot;assets/img/dogs/background_mobile_final.webp&quot;) top / cover;"></div>
                            </div>
                            <div class="col-lg-6" style="background: var(--bs-card-bg);">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Login</h4>
                                        <p style="    color: red;font-weight: 600; text-align: center;"><?php if (isset($_SESSION['erro_login_dashboard'])) { echo $_SESSION['erro_login_dashboard']; unset($_SESSION['erro_login_dashboard']); } ?></p>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="mb-3"><input class="form-control form-control-user" type="email" placeholder="Email" name="email" required></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password" required></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1" checked><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" type="submit" name="login">Login</button>
                                        
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="#">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="/index.php">Go Back to the Main Page</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-white sticky-footer" style="position: fixed;width: 100%;bottom: 0;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Tap&amp;Go 2023</span></div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>