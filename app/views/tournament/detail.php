<?php require_once '../app/views/templates/headerPlayer.php'; ?>

<div class="container py-5">
    <div class="card shadow-lg border-0">
        <img src="<?= BASEURL . '/img/' . $game['detail_img_path']; ?>" alt="<?= $game['name']; ?>" class="game-banner">
        <div class="card-body">
            <h2 class="card-title text-primary"><?= htmlspecialchars($tournament['name']) ?></h2>
            <p class="text-muted mb-1">
                🎮 <?= $tournament['game_name'] ?> &nbsp;|&nbsp; 🏢 Diselenggarakan oleh: <?= $tournament['organizer_name'] ?>
            </p>

            <!-- Navigasi Tab -->
            <ul class="nav nav-tabs mt-4" id="tournamentTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="stages-tab" data-bs-toggle="tab" data-bs-target="#stages" type="button" role="tab">Stages</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="matches-tab" data-bs-toggle="tab" data-bs-target="#matches" type="button" role="tab">Matches</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="participants-tab" data-bs-toggle="tab" data-bs-target="#participants" type="button" role="tab">Participants</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rules-tab" data-bs-toggle="tab" data-bs-target="#rules" type="button" role="tab">Rules</button>
                </li>
            </ul>

            <!-- Isi Tab -->
            <div class="tab-content mt-3" id="tournamentTabsContent">
                <!-- Overview -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                    <p class="mt-2"><?= nl2br(htmlspecialchars($tournament['description'])) ?></p>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            📅 <strong>Tanggal:</strong><br>
                            <?= date('d M Y', strtotime($tournament['start_date'])) ?> – <?= date('d M Y', strtotime($tournament['end_date'])) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            📝 <strong>Registrasi sampai:</strong><br>
                            <?= date('d M Y', strtotime($tournament['registration_deadline'])) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            🟢 <strong>Status Turnamen:</strong><br>
                            <?= ucfirst($tournament['status']) ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            👥 <strong>Tim Terdaftar:</strong><br>
                            <?= $teamCount ?> / <?= $tournament['max_teams'] ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            💰 <strong>Total Hadiah:</strong><br>
                            Rp <?= number_format((int) str_replace(['Rp.', '.', ','], '', $tournament['prize_pool']), 0, ',', '.') ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            💸 <strong>Biaya Registrasi:</strong><br>
                            Rp <?= number_format($tournament['registration_fee'], 0, ',', '.') ?>
                        </div>
                    </div>
                </div>

                <!-- Stages -->
                <div class="tab-pane fade" id="stages" role="tabpanel">
                    <p class="text-muted mt-2">Tahapan turnamen akan ditampilkan di sini.</p>
                </div>

                <!-- Matches -->
                <div class="tab-pane fade" id="matches" role="tabpanel">
                    <?php if (count($matches) > 0): ?>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Tim 1</th>
                                    <th>Skor</th>
                                    <th>Tim 2</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($matches as $match): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($match['team1_name']) ?></td>
                                        <td><?= $match['score_team1'] ?> - <?= $match['score_team2'] ?></td>
                                        <td><?= htmlspecialchars($match['team2_name']) ?></td>
                                        <td><?= ucfirst($match['status']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted mt-2">Belum ada jadwal pertandingan.</p>
                    <?php endif; ?>
                </div>

                <!-- Participants -->
                <div class="tab-pane fade" id="participants" role="tabpanel">
                    <?php if (count($teams) > 0): ?>
                        <ul class="list-group mt-3">
                            <?php foreach ($teams as $team): ?>
                                <li class="list-group-item">👥 <?= htmlspecialchars($team['name']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mt-2">Belum ada tim yang mendaftar.</p>
                    <?php endif; ?>
                </div>

                <!-- Rules -->
                <div class="tab-pane fade" id="rules" role="tabpanel">
                    <p class="text-muted mt-2">Aturan lengkap turnamen akan ditampilkan di sini.</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-4">
                <?php if ($registration_open): ?>
                    <?php if ($is_player_logged_in): ?>
                        <a href="<?= BASEURL ?>/register/tournament/<?= $tournament['id'] ?>" class="btn btn-primary">
                            🚀 Daftar Sekarang
                        </a>
                    <?php else: ?>
                        <a href="<?= BASEURL ?>/player/login" class="btn btn-warning text-white">
                            🔐 Login untuk Mendaftar
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-danger mt-3 mb-0">
                        🚫 Registrasi telah ditutup
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php require_once '../app/views/templates/footer.php'; ?>
