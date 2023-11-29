<?php

$page_title = "Log In";
require_once(__DIR__ . '/partials/Header.inc.php');
require_once(__DIR__ . '/partials/Nav.inc.php');
?>

<section class="form-section" id="f-sect">
  <div class="wrapper">
    <div class="container shadow bg-light rounded-3 ">
      <div class="row">
        <h1>
          Login
        </h1>
        <form action="<?= baseurl() ?>/auth/login/" method="POST">
          <?php Session::warning('LOGIN-WARNING') ? Session::warning('LOGIN-WARNING') : '' ?>
          <?php Session::danger('LOGIN-ERROR') ? Session::danger('LOGIN-ERROR') : '' ?>
          <?php Session::success('LOGIN-SUCCESS') ? Session::success('LOGIN-SUCCESS') : '' ?>
          <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>">
          <div class="col-12">
            <div class="form-group col-12">
              <label for="emailInput" class="form-label ">Trace email</label>
              <input type="email" class="form-control rounded-0 " name="email" value="<?= old_value('email') ?>" id="emailInput">
            </div>
            <div class="form-group password-container col-12">
              <label for="passwordInput" class="form-label">Password</label>
              <input type="password" class="form-control rounded-0" name="password" value="<?= old_value('password') ?>" id="passwordInput">
              <i class="fa-regular fa-eye" id="show-password"></i>
              <div class="form-check col-12 pt-1">
                <label for="checkboxInput" class="form-check-label">Remember me</label>
                <input type="checkbox" class="form-check-input" name="checkbox" id="checkboxInput">
              </div>
            </div>
            <div class="form-group d-grid col-12 py-3">
              <button type="submit" class="btn btn-primary" name="login_submit">Login</button>
            </div>
            <div class="text-center pb-2">
              <a href="<?= baseurl() ?>/account/forgot_password" class="f-btn ">Forgot password?</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  const showPassword = document.querySelector("#show-password");
  const passwordField = document.querySelector("#passwordInput");

  showPassword.addEventListener("click", function() {
    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash", !this.classList.contains("fa-eye"));
    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);
  })
</script>


<?php
require_once(__DIR__ . '/partials/Footer.inc.php');
?>