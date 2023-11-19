<?php

$page_title = "Sign Up";
require_once(__DIR__ . '/partials/Header.inc.php');

require_once(__DIR__ . '/partials/Nav.inc.php');
?>

<section class="form-section d-flex justify-content-center align-items-center">
    <div class="container bg-light shadow rounded-3 mx-3" style="width: 576px;">
        <form action="<?= baseurl() ?>/auth/signup" method="POST">
            <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>">
            <div class="row px-1 py-2 p-sm-4">
                <h2 class="py-4">SIGN UP</h2>
                <!-- start error display -->
                <?php Session::warning('signup-error-domain') ? Session::warning('signup-error-domain') : ''?>
                <?php Session::danger('signup-error') ? Session::success('signup-error') : ''?>
                <?php Session::success('success') ? Session::success('success') : '' ?>
                <?php Session::danger('danger') ? Session::danger('danger') : '' ?>
                <!-- end error display -->
                <div class="col-sm-6 col-12">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="fname" value="<?= old_value('firstname') ?>" name="firstname" class="form-control" id="firstName">
                </div>
                <div class="col-sm-6 col-12">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="lname" value="<?= old_value('lastname') ?>" name="lastname" class="form-control" id="lastName" placeholder="">
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">TRACE E-mail</label>
                    <input type="email" value="<?= old_value('email') ?>" name="email" class="form-control" id="email" placeholder="">
                </div>
                <div class="col-sm-6 col-12">
                    <label for="createPassword" class="form-label">Create password</label>
                    <input type="password" value="<?= old_value('password') ?>" name="password" class="form-control" id="createPassword" placeholder="">
                </div>
                <div class="col-sm-6 col-12">
                    <label for="confirmPassword" class="form-label ">Confirm password</label>
                    <input type="password" value="<?= old_value('confirm_password') ?>" name="confirm_password" class="form-control" id="confirmPassword" placeholder="">
                </div>
                <div class="col-6 pt-3">
                    <select name="grade_level" class="form-select">
                        <option value="" selected disabled>Grade Level</option>
                        <option value="g11">Grade 11</option>
                        <option value="g12">Grade 12</option>
                    </select>
                </div>
                <div class="col-6 pt-3">
                    <select name="strand" class="form-select">
                        <option value="" selected disabled>Strand</option>
                        <option value="abm">ABM</option>
                        <option value="stem">STEM</option>
                        <option value="humss">HUMSS</option>
                        <option value="ict">TVL-ICT</option>
                        <option value="he">TVL-HE</option>
                        <option value="gas">GAS</option>
                    </select>
                </div>
                <div class="d-grid col-12 mx-auto py-4">
                    <button type="submit" class="btn btn-primary ">Sign Up</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php require_once(__DIR__ . '/partials/Footer.inc.php') ?>