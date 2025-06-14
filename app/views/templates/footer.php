<!-- Confirm Logout -->
<script>
function confirmLogout() {
  Swal.fire({
    title: 'Yakin ingin logout?',
    text: "Sesi kamu akan berakhir.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#aaa',
    confirmButtonText: 'Ya, logout'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "<?= BASEURL ?>/organizer/logout";
    }
  });
}
</script>

<!-- SweetAlert on login -->
<?php if (isset($_SESSION['login_success'])): ?>
<script>
Swal.fire({
  icon: 'success',
  title: 'Berhasil Login!',
  text: 'Selamat datang kembali, <?= $data['organizer']['org_name']; ?> 👋',
  showConfirmButton: false,
  timer: 2000
});
</script>
<?php unset($_SESSION['login_success']); endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
