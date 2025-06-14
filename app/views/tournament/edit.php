<div class="container py-5">
  <h2 class="mb-4 text-primary">✏️ Edit Turnamen</h2>

  <form action="<?= BASEURL; ?>/tournament/update/<?= $data['tournament']['id']; ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="name" class="form-label">Nama Turnamen</label>
      <input type="text" name="name" class="form-control" value="<?= $data['tournament']['name']; ?>" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea name="description" class="form-control" rows="4"><?= $data['tournament']['description']; ?></textarea>
    </div>

    <div class="mb-3">
      <label for="prize_pool" class="form-label">Total Hadiah</label>
      <input type="number" name="prize_pool" class="form-control" value="<?= $data['tournament']['prize_pool']; ?>">
    </div>

    <div class="mb-3">
    <label for="max_teams" class="form-label">Jumlah Tim Maksimal</label>
    <input type="number" name="max_teams" class="form-control" value="<?= $data['tournament']['max_teams']; ?>">
    </div>

    <div class="mb-3">
    <label for="registration_fee" class="form-label">Biaya Pendaftaran</label>
    <input type="number" name="registration_fee" class="form-control" value="<?= $data['tournament']['registration_fee']; ?>">
    </div>

    <div class="mb-3">
    <label for="registration_deadline" class="form-label">Tenggat Pendaftaran</label>
    <input type="date" name="registration_deadline" class="form-control" value="<?= $data['tournament']['registration_deadline']; ?>">
    </div>

    <div class="mb-3">
    <label for="allow_solo" class="form-label">Boleh Solo?</label>
    <select name="allow_solo" class="form-select">
        <option value="1" <?= $data['tournament']['allow_solo'] ? 'selected' : ''; ?>>Ya</option>
        <option value="0" <?= !$data['tournament']['allow_solo'] ? 'selected' : ''; ?>>Tidak</option>
    </select>
    </div>

    <div class="mb-3">
    <label for="start_date" class="form-label">Tanggal Mulai</label>
    <input type="date" name="start_date" class="form-control" value="<?= $data['tournament']['start_date']; ?>">
    </div>

    <div class="mb-3">
    <label for="end_date" class="form-label">Tanggal Selesai</label>
    <input type="date" name="end_date" class="form-control" value="<?= $data['tournament']['end_date']; ?>">
    </div>

    <div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="upcoming" <?= $data['tournament']['status'] == 'upcoming' ? 'selected' : ''; ?>>Upcoming</option>
        <option value="ongoing" <?= $data['tournament']['status'] == 'ongoing' ? 'selected' : ''; ?>>Ongoing</option>
        <option value="completed" <?= $data['tournament']['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
    </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="<?= BASEURL; ?>/organizer/dashboard" class="btn btn-secondary">Batal</a>
  </form>
</div>
