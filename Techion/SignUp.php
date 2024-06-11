<?php 
session_start();
include("koneksi.php");

function login($koneksi, $email, $password) {
    $email = mysqli_real_escape_string($koneksi, $email);
    $password = mysqli_real_escape_string($koneksi, $password);

    $sql = "SELECT * FROM tbl_users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $email;
        $_SESSION['usertype'] = $user['usertype'];
        return true;
    } else {
        return false;
    }
}

function createAccount($koneksi, $name, $email, $password) {
    $name = mysqli_real_escape_string($koneksi, $name);
    $email = mysqli_real_escape_string($koneksi, $email);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Default usertype ke 'customer'
    $usertype = 'customer';

    $sql = "INSERT INTO tbl_users (name, email, password, usertype) VALUES ('$name', '$email', '$password', '$usertype')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (login($koneksi, $email, $password)) {
        if ($_SESSION['usertype'] == 'admin') {
            header("Location: mentor/halaman.php");
            exit();
        } else {
            header("Location: student/halaman.php");
            exit();
        }
    } else {
        $loginError = "Email atau password salah.";
    }
}

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (createAccount($koneksi, $name, $email, $password)) {
        $signupSuccess = "Akun berhasil dibuat. Silakan login.";
    } else {
        $signupError = "Gagal membuat akun.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in || Sign up from</title>
     <!-- font awesome icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css stylesheet -->
    <link rel="stylesheet" href="SignUp.css">
</head>
<body>

    <div class="container" id="container">
        <!-- Sign up -->
        <div class="form-container sign-up-container">
            <form action="#" method="POST">
                <h1>Create Account</h1>
                <!-- show message signup -->
                <?php if(isset($signupSuccess)) { ?>
                    <div class="success"><?php echo $signupSuccess; ?></div>
                <?php } ?>
                <?php if(isset($signupError)) { ?>
                    <div class="error"><?php echo $signupError; ?></div>
                <?php } ?>
                <!-- end show msg -->
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <div class="infield">
                    <input type="text" placeholder="Name" name="name" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" placeholder="Email" name="email" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="password" required/>
                    <label></label>
                </div>
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
        <!-- End Sign Up -->

        <!-- Sign in -->
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1>Sign in</h1>
                <?php if(isset($loginError)) { ?>
                    <div class="error"><?php echo $loginError; ?></div>
                <?php } ?>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <div class="infield">
                    <input type="email" placeholder="Email" name="email" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="password" required />
                    <label></label>
                </div>
                <a href="#" class="forgot">Forgot your password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>

        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button>Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button>Sign Up</button>
                </div>
            </div>
            <button id="overlayBtn"></button>
        </div>
    </div>
    
    <!-- js code -->
    <script>
        const container = document.getElementById('container');
        const overlayCon = document.getElementById('overlayCon');
        const overlayBtn = document.getElementById('overlayBtn');

        overlayBtn.addEventListener('click', ()=> {
            container.classList.toggle('right-panel-active');    

            overlayBtn.classList.remove('btnScaled');
            window.requestAnimationFrame( ()=> {
                overlayBtn.classList.add('btnScaled');
            })
        });

    </script>

</body>
</html>