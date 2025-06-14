<div class="container mt-5" style="max-width: 750px;">
  <h2 class="mb-4">Buat Turnamen Baru</h2>

  <form method="post" action="<?= BASEURL; ?>/tournament/store" enctype="multipart/form-data">
    <!-- Nama Turnamen -->
    <div class="mb-3">
      <label for="name" class="form-label">Nama Turnamen</label>
      <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <!-- Dropdown Game -->
    <div class="mb-3">
      <label for="game_id" class="form-label">Pilih Game</label>
      <select class="form-select" name="game_id" id="game_id" required>
        <option disabled selected>-- Pilih Game --</option>
        <?php foreach ($data['games'] as $game): ?>
          <option value="<?= $game['id']; ?>"><?= $game['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Deskripsi -->
    <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
    </div>

    <!-- Prize Pool -->
    <div class="mb-3">
      <label for="prize_pool" class="form-label">Prize Pool</label>
      <input type="text" class="form-control" name="prize_pool" id="prize_pool" required>
    </div>

    <!-- Max Teams & Registration Fee -->
    <div class="row mb-3">
      <div class="col">
        <label for="max_teams" class="form-label">Tim Maksimal</label>
        <input type="number" class="form-control" name="max_teams" id="max_teams" required>
      </div>
      <div class="col">
        <label for="registration_fee" class="form-label">Biaya Pendaftaran</label>
        <input type="number" step="0.01" class="form-control" name="registration_fee" id="registration_fee" required>
      </div>
    </div>

    <!-- Tanggal -->
    <div class="row mb-3">
      <div class="col">
        <label for="registration_deadline" class="form-label">Batas Pendaftaran</label>
        <input type="datetime-local" class="form-control" name="registration_deadline" id="registration_deadline" required>
      </div>
      <div class="col">
        <label for="start_date" class="form-label">Tanggal Mulai</label>
        <input type="datetime-local" class="form-control" name="start_date" id="start_date" required>
      </div>
      <div class="col">
        <label for="end_date" class="form-label">Tanggal Selesai</label>
        <input type="datetime-local" class="form-control" name="end_date" id="end_date" required>
      </div>
    </div>

    <!-- Allow Solo & Status -->
    <div class="row mb-3">
      <div class="col">
        <div class="form-check mt-4">
          <input class="form-check-input" type="checkbox" name="allow_solo" id="allow_solo" value="1">
          <label class="form-check-label" for="allow_solo">Izinkan Solo Player</label>
        </div>
      </div>
      <div class="col">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" name="status" id="status">
          <option value="upcoming" selected>Upcoming</option>
          <option value="ongoing">Ongoing</option>
          <option value="completed">Completed</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn btn-primary w-100">Simpan Turnamen</button>
  </form>
</div>
