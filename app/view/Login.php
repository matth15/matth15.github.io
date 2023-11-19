<?php

$page_title = "Log In";
require_once(__DIR__.'/partials/Header.inc.php');
require_once(__DIR__.'/partials/Nav.inc.php');
?>

<section class="form-section">
  <div class="wrapper">
    <div class="container shadow bg-light rounded-3 ">
      <div class="row">
        <h1>
          Login
        </h1>
        <form action="<?= baseurl() ?>/auth/login/" method="POST">
        <?php Session::danger('login-error') ? Session::success('login-error') : '' ?>
        <?php Session::success('success') ? Session::success('success') : '' ?>
        <?php Session::danger('danger') ? Session::danger('danger') : '' ?>
          <!-- <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>"> -->
          <div class="col-12">
            <div class="form-group col-12">
              <label for="emailInput" class="form-label ">Trace email</label>
              <input type="email" class="form-control " name="email" value="<?= old_value('email') ?>" id="emailInput">
            </div>
            <div class="form-group col-12">
              <label for="passwordInput" class="form-label">Password</label>
              <input type="password" class="form-control  " name="password" value="<?= old_value('password') ?>" id="passwordInput">
              <div class="form-check col-12 pt-1">
                <label for="checkboxInput" class="form-check-label">Remember me</label>
                <input type="checkbox" class="form-check-input" name="checkbox" id="checkboxInput">
              </div>
            </div>
            <div class="form-group d-grid col-12 py-3">
              <button type="submit" class="btn btn-primary" name="login_submit">Login</button>
            </div>
            <a href="<?= baseurl()?>/auth/forgot_password">Forgot password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php
require_once(__DIR__.'/partials/Footer.inc.php');
?>