<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $data['judul']; ?> | Tournament Organizer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Styles (optional) -->
    <style>
        body {
            background: linear-gradient(to right,rgb(182, 194, 253),rgb(212, 212, 212));
        }
        .game-logo {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.2s;
        }
        .game-logo:hover {
            transform: scale(1.05);
        }
        .main-title {
            margin: 40px 0 20px;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= BASEURL; ?>/home">🎮 Tournament</a>
    <div class="ms-auto">
      <a href="<?= BASEURL; ?>/organizer/logout" class="btn btn-outline-light">Logout</a>
    </div>
  </div>
</nav>


