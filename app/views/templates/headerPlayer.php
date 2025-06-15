<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($data['judul']) ? $data['judul'] . ' | Tournament' : 'Tournament' ?></title>
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
        <a class="navbar-brand fw-bold" href="<?= BASEURL ?>/home">🎮 Tournament</a>
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

                <a href="<?= BASEURL ?>/organizer/login" class="btn btn-light">Organize</a>
            </div>
        </div>
    </div>
</nav>

<style>
.tournament-bracket {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: flex-start;
    gap: 30px;
    padding: 20px;
    overflow-x: auto;
    background: #1a202c;
    border-radius: 12px;
    margin-top: 20px;
}

.round-title {
    font-size: 18px;
    font-weight: bold;
    color: #a0aec0;
    margin-bottom: 30px;
    text-align: center;
}

.bracket-matches {
    display: flex;
    flex-direction: column;
    gap: 40px;
    width: 100%;
}

.bracket-match {
    background: #2d3748;
    border-radius: 8px;
    border: 1px solid #4a5568;
    overflow: hidden;
    min-height: 80px;
}

.match-team {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    border-bottom: 1px solid #4a5568;
    color: #e2e8f0;
}

.match-team:last-child {
    border-bottom: none;
}

.match-team.winner {
    background: #2d5a27;
    color: #68d391;
    font-weight: bold;
}

.team-name {
    font-size: 14px;
    font-weight: 500;
}

.team-score {
    font-size: 16px;
    font-weight: bold;
    min-width: 20px;
    text-align: center;
}

.tbd-match {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px 20px;
    color: #a0aec0;
    font-style: italic;
}

/* Hapus connector lama dan ganti dengan ini */
.bracket-round {
    position: relative;
}

/* Garis penghubung setelah bracket-round (kecuali yang terakhir) */
.bracket-round:not(:last-child)::after {
    content: '';
    position: absolute;
    right: -30px;
    top: 0;
    bottom: 0;
    width: 60px;
    background: transparent;
    pointer-events: none;
}

/* Garis horizontal untuk setiap match */
.bracket-match {
    position: relative;
}



@media (max-width: 767px) {
    .tournament-bracket {
        flex-direction: column;
        gap: 20px;
    }
    
    .bracket-connector {
        display: none;
    }
}
</style>
