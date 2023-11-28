<?php
$page_title = "Forgot password";
require __DIR__ . '/partials/Header.inc.php';
include __DIR__ . '/partials/Nav.inc.php';
?>
<section class="form-section " id="f-sect">
    <div class="wrapper">
        <div class="container shadow bg-light rounded-3 ">
            <div class="row">
                <h2>
                    Forgot password
                </h2>
                <form action="<?= baseurl() ?>/account/forgot_password" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>">
                    <?php Session::success('FORGOT-PASSWORD-SUCCESS') ?  Session::success('FORGOT-PASSWORD-SUCCESS') : ''; ?>
                    <?php Session::danger('FORGOT-PASSWORD-DANGER') ?  Session::danger('FORGOT-PASSWORD-DANGER') : ''; ?>
                    <div class="col-12">
                        <div class="form-group col-12">
                            <label for="emailInput" class="form-label">Enter your trace email</label>
                            <input type="email" class="form-control rounded-0" name="email" id="emailInput" placeholder="Trace email">
                        </div>
                        <div class="form-group d-flex justify-content-end  col-12 py-2">
                            <button type="submit" class="btn btn-primary" name="forgot-password_submit">Submit</button>
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