<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .login {
            display: flex;
            justify-content: center;
            font-weight: bold;
            color: #4a934a;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
        .captcha-container {
            display: none;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <?php if (session()->getFlashdata('toast_message')): ?>
            <div class="alert alert-<?= session()->getFlashdata('toast_type') == 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('toast_message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="<?= base_url('images/' . $setting->login_icon) ?>" alt="" width="127px" height="130px">
                    </a>
                </div>
                <div class="login-form">
                    <form id="loginForm" action="<?= base_url('home/aksi_login') ?>" method="POST">
                        <h2 class="login">LOGIN</h2>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <!-- CAPTCHA gambar -->
                        <div class="form-group captcha-container" id="captchaContainer">
                            <label for="captcha_code">Enter CAPTCHA</label>
                            <input type="text" class="form-control" id="captcha_code" name="captcha_code" placeholder="Enter CAPTCHA code" required>
                            <img id="captchaImage" src="" alt="CAPTCHA">
                        </div>
                        <div class="form-group" id="recaptchaContainer" style="display: none;">
                            <div class="g-recaptcha" data-sitekey="6LeKfiAqAAAAAIYfzHJCoT6fOpGTpktdJza3fixn"></div>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have an account? <a href="<?= base_url('home/signup') ?>">Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const captchaContainer = document.getElementById('captchaContainer');
        const recaptchaContainer = document.getElementById('recaptchaContainer');
        const captchaCodeInput = document.getElementById('captcha_code');
        const captchaImage = document.getElementById('captchaImage');

        if (navigator.onLine) {
            // Jika ada koneksi internet, tampilkan Google reCAPTCHA
            recaptchaContainer.style.display = 'block';
            captchaContainer.style.display = 'none';
            captchaCodeInput.removeAttribute('required'); // Hapus required jika CAPTCHA gambar tidak ditampilkan
        } else {
            // Jika tidak ada koneksi internet, tampilkan CAPTCHA gambar
            recaptchaContainer.style.display = 'none';
            captchaContainer.style.display = 'block';
            captchaCodeInput.setAttribute('required', 'required'); // Tambahkan required jika CAPTCHA gambar ditampilkan
            captchaImage.src = '<?= base_url('home/generateCaptcha') ?>'; // URL ke fungsi CAPTCHA gambar
        }
    });
</script>
</body>
</html>
