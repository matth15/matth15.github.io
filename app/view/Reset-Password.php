<?php 

$page_title = "Forgot password";
require_once __DIR__.'/partials/Header.inc.php';
include_once __DIR__.'/partials/Nav.inc.php';
?>
<section class="form-section">
    <div class="wrapper">
        <div class="container shadow bg-light rounded-3">
            <div class="row">
              <h2>
                New password
              </h2>
              <?php 
              //display error
              
              //end
              ?>
                
              <form action="" method="POST">
                <div class="col-12 p-2">
                    <div class="form-group col-12">
                      <label for="newPasswordInput" class="form-label">Enter new password</label>
                      <input type="password" class="form-control" name="new_password" id="newPasswordInput">
                    </div>
                    <div class="form-group col-12">
                      <label for="confirmPasswordInput" class="form-label">Confirm new password</label>
                      <input type="password" class="form-control " name="new_confirm_password" id="confirmPasswordInput">
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
include (__DIR__.'/partials/Footer.inc.php');
?>
