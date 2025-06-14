<div class="container py-5">
    <!-- Enhanced Hero Section -->
    <div class="hero-section">
        <div class="text-center">
            <h1 class="hero-title display-4 fw-bold">Welcome to the World of Esports Tournaments</h1>
            <p class="hero-subtitle lead">Join, organize, and compete like a pro in the most thrilling gaming battles.</p>
        </div>
    </div>

    <!-- Game Section -->
    <h2 id="popular-games" class="section-title">Popular Games</h2>
    <div class="games-container">
        <?php foreach ($data['games'] as $game) : ?>
            <a href="<?= BASEURL ?>/games/detail/<?= $game['slug']; ?>" class="game-card-home">
                <img src="<?= BASEURL; ?>/img/<?= $game['image_path']; ?>" class="game-logo" alt="<?= $game['name']; ?>">
                <h6 class="card-title fw-semibold"><?= $game['name']; ?></h6>
            </a>
        <?php endforeach; ?>
    </div>
</div>