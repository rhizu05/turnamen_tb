<?php require_once '../app/views/templates/header.php'; ?>

<!-- Bootstrap Form -->
<div class="container mt-5">
    <h2>Daftar Turnamen: <?= $tournament['name']; ?></h2>

    <form action="<?= BASEURL ?>/tournament/registerSave" method="POST">
        <input type="hidden" name="tournament_id" value="<?= $tournament['id']; ?>">

        <div class="mb-3">
            <label for="team_name" class="form-label">Nama Tim</label>
            <input type="text" class="form-control" name="team_name" required>
        </div>

        <div class="mb-3">
            <label for="player_ids" class="form-label">ID Pemain 1</label>
            <input type="text" class="form-control" name="player_ids[]" placeholder="Masukkan ID Anda" required>
            <label for="player_ids" class="form-label">ID Pemain 2</label>
            <input type="text" class="form-control" name="player_ids[]" placeholder="Masukkan ID Anda" required>
            <label for="player_ids" class="form-label">ID Pemain 3</label>
            <input type="text" class="form-control" name="player_ids[]" placeholder="Masukkan ID Anda" required>
            <label for="player_ids" class="form-label">ID Pemain 4</label>
            <input type="text" class="form-control" name="player_ids[]" placeholder="Masukkan ID Anda" required>
            <label for="player_ids" class="form-label">ID Pemain 5</label>
            <input type="text" class="form-control" name="player_ids[]" placeholder="Masukkan ID Anda" required>
            <small class="text-muted">*Untuk sementara input ID manual, nanti bisa dibuat dropdown.</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit Pendaftaran</button>
    </form>
</div>
