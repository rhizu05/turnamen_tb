<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul']; ?> | Tournament</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right,rgb(29, 10, 76),rgb(45, 4, 4));
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
<body class="bg-dark text-white">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">🎮 Tournament</a>
        <div class="d-flex ms-auto">
            <a href="#" class="btn btn-outline-light me-2">Login</a>
        </div>
    </div>
</nav>
