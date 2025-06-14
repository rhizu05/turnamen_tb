<div class="container mt-5">
    <h1 class="mb-4 text-center" style="font-weight: 700; color: #ffffff; text-shadow: 0 2px 10px rgba(0,0,0,0.5);"><?= $game['name']; ?></h1>
    
    <div class="d-flex justify-content-center mb-4">
        <img src="<?= BASEURL . '/img/' . $game['detail_img_path']; ?>" alt="<?= $game['name']; ?>" class="game-banner">
    </div>
    
    <!-- Tabs Status -->
    <ul class="nav nav-tabs justify-content-center mb-4">
        <?php
        $statuses = ['upcoming' => 'Upcoming', 'ongoing' => 'Ongoing', 'completed' => 'Completed'];
        foreach ($statuses as $key => $label):
            $active = ($key == $status) ? 'active' : '';
        ?>
            <li class="nav-item">
                <a class="nav-link <?= $active; ?>" href="<?= BASEURL; ?>/games/<?= $game['slug']; ?>?status=<?= $key; ?>">
                    <?= $label; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if (empty($tournaments)) : ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            Tidak ada turnamen dengan status <strong><?= $statuses[$status]; ?></strong>.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($tournaments as $tournament): ?>
                <div class="col">
                    <div class="card h-100 tournament-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $tournament['name']; ?></h5>
                            <p class="card-text">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Mulai: <?= date('d M Y', strtotime($tournament['start_date'])); ?><br>
                                <i class="fas fa-trophy me-2"></i>
                                Status: <span class="badge bg-secondary"><?= ucfirst($status); ?></span>
                            </p>
                            <a href="<?= BASEURL; ?>/tournament/detail/<?= $tournament['id']; ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>