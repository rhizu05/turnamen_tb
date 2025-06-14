<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right,rgb(87, 81, 101), #fbc2eb);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .auth-card {
      background: #fff;
      border-radius: 20px;
      padding: 40px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 text-success">📝 Register Player</h3>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="<?= BASEURL ?>/player/register" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">👤 Username</label>
                            <input type="text" name="username" id="username" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">📧 Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">🔑 Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="nickname" class="form-label">🎮 Nickname (Opsional)</label>
                            <input type="text" name="nickname" id="nickname" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">Daftar</button>
                    </form>

                    <div class="text-center mt-3">
                        Sudah punya akun? <a href="<?= BASEURL ?>/player/login" class="text-decoration-none">Masuk di sini</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/footer.php'; ?>
