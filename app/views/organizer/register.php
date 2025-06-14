<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register Organizer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right,rgb(87, 81, 101),rgb(7, 34, 78));
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .card {
      border-radius: 20px;
    }
    .form-control {
      border-radius: 12px;
    }
    .btn-primary {
      border-radius: 12px;
    }
    .form-label {
      font-weight: 600;
    }
    .text-muted a {
      color: #0d6efd;
      font-weight: 500;
    }
    .text-muted a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container mt-5" style="max-width: 600px;">
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-5">
      <h2 class="card-title text-center mb-4 fw-bold text-primary">Register Organizer</h2>

      <form method="post" novalidate>
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" name="firstName" id="firstName" class="form-control form-control-lg shadow-sm" placeholder="Your first name" required>
            <div class="invalid-feedback">Please enter your first name.</div>
          </div>
          <div class="col-md-6">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" name="lastName" id="lastName" class="form-control form-control-lg shadow-sm" placeholder="Your last name" required>
            <div class="invalid-feedback">Please enter your last name.</div>
          </div>
        </div>

        <div class="mb-3">
          <label for="org_name" class="form-label">Organization Name</label>
          <input type="text" name="org_name" id="org_name" class="form-control form-control-lg shadow-sm" placeholder="Your organization" required>
          <div class="invalid-feedback">Organization name is required.</div>
        </div>

        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <input type="text" name="country" id="country" class="form-control form-control-lg shadow-sm" placeholder="Country you’re based in" required>
          <div class="invalid-feedback">Country is required.</div>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" name="phone" id="phone" class="form-control form-control-lg shadow-sm" placeholder="+62 812 3456 7890" required>
          <div class="invalid-feedback">Please provide your phone number.</div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" name="email" id="email" class="form-control form-control-lg shadow-sm" placeholder="example@mail.com" required>
          <div class="invalid-feedback">Please enter a valid email address.</div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control form-control-lg shadow-sm" placeholder="At least 6 characters" minlength="6" required>
          <div class="invalid-feedback">Password must be at least 6 characters.</div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm" style="letter-spacing: 1px;">
          Register Now
        </button>
      </form>

      <div class="text-center mt-4">
        <small class="text-muted">
          Already have an account? <a href="<?= BASEURL; ?>/organizer/login" class="text-decoration-none">Login here</a>
        </small>
      </div>
    </div>
  </div>
</div>

<script>
// Bootstrap custom validation
(() => {
  'use strict';
  const forms = document.querySelectorAll('form');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>

</body>
</html>
