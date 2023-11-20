<?php

$page_title = "Forgot password";
require_once __DIR__ . '/partials/Header.inc.php';
require_once __DIR__ . '/partials/Nav.inc.php';
?>
<section class="form-section">
  <div class="wrapper">
    <div class="container shadow bg-light rounded-3">
      <div class="row">
        <h2>
          New password
        </h2>
        <form action="" method="POST">
          <?php Session::success('RESET-PASSWORD-SUCCESS') ?  Session::success('RESET-PASSWORD-SUCCESS') : ''; ?>
          <?php Session::danger('RESET-PASSWORD-DANGER') ?  Session::danger('RESET-PASSWORD-DANGER') : ''; ?>
          <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>">
          <div class="col-12 p-2">
            <div class="form-group col-12">
              <label for="newPasswordInput" class="form-label">Enter new password</label>
              <input type="password" class="form-control" name="n_pass" id="newPasswordInput">
            </div>
            <div class="form-group col-12">
              <label for="confirmPasswordInput" class="form-label">Confirm new password</label>
              <input type="password" class="form-control " name="n_cpass" id="confirmPasswordInput">
            </div>
            <div class="form-group col-12 d-flex justify-content-end py-2">
              <button type="submit" name="reset-password_submit" class="btn btn-primary">Confirm</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php
include(__DIR__ . '/partials/Footer.inc.php');
?>