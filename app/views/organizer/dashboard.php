<div class="container py-5">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-primary">🎮 Organizer Dashboard</h2>
      <p class="text-muted mb-0">Kelola turnamen game kamu dengan mudah dan cepat.</p>
    </div>
  </div>

  <!-- Welcome Alert -->
  <div class="alert alert-success shadow-sm rounded-pill px-4" role="alert">
    Halo <strong><?= $_SESSION['organizer']['org_name']; ?></strong>, selamat datang di panel organizer kamu! 🚀
  </div>

  <!-- Buat Turnamen -->
  <div class="mb-4 text-end">
    <a href="<?= BASEURL; ?>/tournament/create" class="btn btn-success shadow-sm">
      + Buat Turnamen Baru
    </a>
  </div>

  <!-- Daftar Turnamen -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h4 class="card-title mb-3">📋 Daftar Turnamen Kamu</h4>

      <?php if (!empty($data['tournaments'])): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          <?php foreach ($data['tournaments'] as $tournament): ?>
            <div class="col">
              <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><?= $tournament['name']; ?></h5>
                  <p class="card-text text-muted small mb-3">
                    Game: <?= $tournament['game']; ?><br>
                    Status: <span class="badge bg-secondary"><?= ucfirst($tournament['status']); ?></span>
                  </p>
                  <div class="mt-auto d-flex justify-content-between">
                    <a href="<?= BASEURL; ?>/tournament/edit/<?= $tournament['id']; ?>" class="btn btn-warning btn-sm">
                      📝 Edit
                    </a>
                    <form action="<?= BASEURL; ?>/tournament/delete/<?= $tournament['id']; ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus turnamen ini?');">
                      <button type="submit" class="btn btn-danger btn-sm">
                        🗑️ Delete
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="alert alert-info text-center mt-4">
          Belum ada turnamen yang kamu buat. Klik tombol <strong>"Buat Turnamen Baru"</strong> untuk memulai.
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
