<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
  <div class="auth-card">
    <h4 class="mb-3 text-center fw-bold text-primary">Login Organizer</h4>
    <form method="post">
      <div class="mb-3">
        <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
      </div>
      <div class="mb-3 text-end">
        <a href="#" class="text-decoration-none small">Lupa password?</a>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
      <div class="mt-3 text-center">
        <small>Belum punya akun? <a href="<?= BASEURL; ?>/organizer/register">Daftar</a></small>
      </div>
    </form>
  </div>
</body>
</html>
