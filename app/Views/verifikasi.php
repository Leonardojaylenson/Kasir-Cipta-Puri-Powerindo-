<style>
    .token{
        display: flex;
        justify-content: center;
        font-weight: bold;
        color: #4a934a;
    }
</style>
<body class="bg-dark">
<div class="container mt-3">
        <?php if (session()->getFlashdata('toast_message')): ?>
            <div class="alert alert-<?= session()->getFlashdata('toast_type') == 'danger' ? 'danger' : 'danger' ?> alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('toast_message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="<?=base_url('images/cipta puri-01.png')?>" alt="" width="127px" height="130px">
                    </a>
                </div>
                <div class="login-form">
                    <form action="<?=base_url('home/verify')?>" method="POST">
                    <h2 class="token">TOKEN</h2>
                        <div class="form-group">
                            <label>Token</label>
                            <input type="text" class="form-control" placeholder="Token" name="token" id="token">
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Verifikasi</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="<?=base_url('home/signup')?>"> Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
