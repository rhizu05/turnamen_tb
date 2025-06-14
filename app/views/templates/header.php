<link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul']; ?> | Tournament</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, rgb(29, 10, 76), rgb(45, 4, 4));
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
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 40px;
            padding: 20px;
        }
        .logo-container a {
            flex: 0 1 180px;
            text-align: center;
        }
    </style>
</head>
<body class="bg-dark text-white">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">🎮 Tournament</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex">
                <?php if (isset($_SESSION['player'])) : ?>
                    <a href="<?= BASEURL ?>/player/logout" class="btn btn-outline-light me-2">Logout</a>
                <?php else : ?>
                    <a href="<?= BASEURL ?>/player/login" class="btn btn-outline-light me-2">Login</a>
                <?php endif; ?>

                <a href="#" class="btn btn-outline-light me-2">Play</a>
                <a href="<?= BASEURL ?>/organizer/login" class="btn btn-light">Organize</a>
            </div>
        </div>
    </div>
</nav>