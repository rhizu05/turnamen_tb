<?php require_once '../app/views/templates/headerPlayer.php'; ?>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" >
        <?= $_SESSION['error_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>


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
                            <?php if (!empty($tournament['start_date'])): ?>
                            <?= date('d M Y', strtotime($tournament['start_date'])) ?>
                            <?php else: ?>
                                <em>Tanggal belum ditentukan</em>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            📝 <strong>Registrasi sampai:</strong><br>
                            <?php if (!empty($tournament['egistration_deadline'])): ?>
                            <?= date('d M Y', strtotime($tournament['egistration_deadline'])) ?>
                            <?php else: ?>
                                <em>Tanggal belum ditentukan</em>
                            <?php endif; ?>
                           
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
                    <?php
                    // Function to calculate tournament structure
                    function calculateTournamentStructure($teamCount) {
                        if ($teamCount < 2) return [];
                        
                        // Find the next power of 2 that can accommodate all teams
                        $nextPowerOf2 = pow(2, ceil(log($teamCount, 2)));
                        
                        $structure = [];
                        $currentRound = $nextPowerOf2;
                        
                        // Generate rounds until we reach final (2 teams)
                        while ($currentRound >= 2) {
                            if ($currentRound == 2) {
                                $structure[] = ['name' => 'Final', 'matches' => 1, 'teams' => 2];
                            } elseif ($currentRound == 4) {
                                $structure[] = ['name' => 'Semi Final', 'matches' => 2, 'teams' => 4];
                            } elseif ($currentRound == 8) {
                                $structure[] = ['name' => 'Quarter Final', 'matches' => 4, 'teams' => 8];
                            } elseif ($currentRound == 16) {
                                $structure[] = ['name' => 'Round of 16', 'matches' => 8, 'teams' => 16];
                            } else {
                                $structure[] = ['name' => 'Round of ' . $currentRound, 'matches' => $currentRound / 2, 'teams' => $currentRound];
                            }
                            $currentRound = $currentRound / 2;
                        }
                        
                        return array_reverse($structure);
                    }
                    
                    // Function to organize existing matches by stage
                    function organizeMatchesByStage($matches, $teamCount) {
                        $nextPowerOf2 = pow(2, ceil(log($teamCount, 2)));
                        $totalMatches = count($matches);
                        $matchesByStage = [];

                        foreach ($matches as $index => $match) {
                            // Tentukan jumlah match di tiap stage berdasarkan struktur
                            if ($nextPowerOf2 == 16) {
                                // R16: 8 match, QF: 4, SF: 2, F: 1
                                if ($index < 8) $stage = 'round1';        // Round of 16
                                elseif ($index < 12) $stage = 'quarterfinal';
                                elseif ($index < 14) $stage = 'semifinal';
                                else $stage = 'final';
                            } elseif ($nextPowerOf2 == 8) {
                                if ($index < 4) $stage = 'round1';        // Quarter Final
                                elseif ($index < 6) $stage = 'semifinal';
                                else $stage = 'final';
                            } elseif ($nextPowerOf2 == 4) {
                                if ($index < 2) $stage = 'semifinal';
                                else $stage = 'final';
                            } elseif ($nextPowerOf2 == 2) {
                                $stage = 'final';
                            } else {
                                $stage = 'round1';
                            }

                            if (!isset($matchesByStage[$stage])) {
                                $matchesByStage[$stage] = [];
                            }

                            $matchesByStage[$stage][] = $match;
                        }

                        return $matchesByStage;
                    }

                    
                    // Function to generate matches for first round from teams
                    function generateFirstRoundMatches($teams, $totalSlots) {
                        $matches = [];
                        $teamList = array_values($teams);
                        
                        // Shuffle teams for random matchmaking
                        shuffle($teamList);
                        
                        // Add bye teams if needed
                        $byeCount = $totalSlots - count($teamList);
                        for ($i = 0; $i < $byeCount; $i++) {
                            $teamList[] = ['name' => 'BYE'];
                        }
                        
                        // Create matches
                        for ($i = 0; $i < count($teamList); $i += 2) {
                            if (isset($teamList[$i + 1])) {
                                $matches[] = [
                                    'team1_name' => $teamList[$i]['name'],
                                    'team2_name' => $teamList[$i + 1]['name'],
                                    'score_team1' => null,
                                    'score_team2' => null,
                                    'status' => 'pending'
                                ];
                            }
                        }
                        
                        return $matches;
                    }
                    function generateNextRoundMatch($matchesByStage, $stageName, $tournament_id) {
                        if ($stageName === 'final') {
                            $semis = $matchesByStage['semifinal'] ?? [];
                            if (count($semis) == 2) {
                                $team1 = $semis[0]['winner_id'];
                                $team2 = $semis[1]['winner_id'];
                                if ($team1 && $team2) {
                                    // Cek apakah final sudah ada?
                                    $finalExists = false;
                                    foreach ($matchesByStage['final'] ?? [] as $final) {
                                        if ($final['team1_id'] == $team1 && $final['team2_id'] == $team2) {
                                            $finalExists = true;
                                            break;
                                        }
                                    }

                                    if (!$finalExists) {
                                        // Simpan ke database
                                        $db = new mysqli("localhost", "root", "", "nama_database");
                                        $stmt = $db->prepare("INSERT INTO matches (tournament_id, team1_id, team2_id, status) VALUES (?, ?, ?, 'pending')");
                                        $stmt->bind_param("iii", $tournament_id, $team1, $team2);
                                        $stmt->execute();
                                        $stmt->close();
                                        $db->close();
                                    }
                                }
                            }
                        }
                    }

                    
                    // Get tournament structure and organize matches
                    $tournamentStructure = calculateTournamentStructure(count($teams));
                    $matchesByStage = organizeMatchesByStage($matches, count($teams));
                    
                    // Generate first round matches if no matches exist
                    if (empty($matches) && count($teams) > 1) {
                        $firstRound = $tournamentStructure[0] ?? null;
                        if ($firstRound) {
                            $firstRoundMatches = generateFirstRoundMatches($teams, $firstRound['teams']);
                            $stageName = strtolower(str_replace([' ', 'of'], ['', ''], $firstRound['name']));
                            $matchesByStage[$stageName] = $firstRoundMatches;
                        }
                    }
                    ?>
                    
                    <?php if (count($teams) < 2): ?>
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle"></i>
                            Bracket akan ditampilkan setelah minimal 2 tim mendaftar.
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle"></i>
                            Tournament Bracket - <?= count($teams) ?> tim terdaftar
                        </div>
                        
                        <div class="tournament-bracket">
                            <?php foreach ($tournamentStructure as $index => $round): ?>
                                <?php
                                // Map round names to stage keys
                                $stageKey = strtolower(str_replace([' ', 'of'], ['', ''], $round['name']));
                                if ($stageKey == 'quarterfinal') $stageKey = 'round1';
                                if ($stageKey == 'semifinal') $stageKey = 'semifinal';
                                if ($stageKey == 'final') $stageKey = 'final';
                                
                                $roundMatches = $matchesByStage[$stageKey] ?? [];
                                ?>
                                
                                <div class="bracket-round">
                                    <div class="round-title"><?= htmlspecialchars($round['name']) ?></div>
                                    <div class="bracket-matches">
                                        <?php if (!empty($roundMatches)): ?>
                                            <?php foreach ($roundMatches as $match): ?>
                                                <div class="bracket-match">
                                                    <?php if ($match['team1_name'] == 'BYE' || $match['team2_name'] == 'BYE'): ?>
                                                        <div class="match-team winner">
                                                            <span class="team-name"><?= $match['team1_name'] == 'BYE' ? htmlspecialchars($match['team2_name']) : htmlspecialchars($match['team1_name']) ?></span>
                                                            <span class="team-score">WIN</span>
                                                        </div>
                                                        <div class="match-team">
                                                            <span class="team-name">BYE</span>
                                                            <span class="team-score">-</span>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="match-team <?= (isset($match['score_team1']) && isset($match['score_team2']) && $match['score_team1'] > $match['score_team2']) ? 'winner' : '' ?>">
                                                            <span class="team-name"><?= htmlspecialchars($match['team1_name']) ?></span>
                                                            <span class="team-score"><?= $match['score_team1'] ?? '-' ?></span>
                                                        </div>
                                                        <div class="match-team <?= (isset($match['score_team1']) && isset($match['score_team2']) && $match['score_team2'] > $match['score_team1']) ? 'winner' : '' ?>">
                                                            <span class="team-name"><?= htmlspecialchars($match['team2_name']) ?></span>
                                                            <span class="team-score"><?= $match['score_team2'] ?? '-' ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <?php for ($i = 0; $i < $round['matches']; $i++): ?>
                                                <div class="bracket-match">
                                                    <div class="tbd-match">
                                                        TBD<br>
                                                        vs<br>
                                                        TBD
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="fas fa-lightbulb"></i>
                                Bracket akan otomatis menyesuaikan dengan jumlah tim yang mendaftar.
                                <?php if (count($teams) != $tournamentStructure[0]['teams']): ?>
                                    Tim yang mendapat BYE akan otomatis maju ke round berikutnya.
                                <?php endif; ?>
                            </small>
                        </div>
                    <?php endif; ?>
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
                                <li class="list-group-item">👥   <?= htmlspecialchars($team['name']) ?></li>
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
                        <a href="<?= BASEURL ?>/tournament/register/<?= $tournament['id'] ?>" class="btn btn-primary">
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
