<?php

$page_title = "Sign Up";
require_once(__DIR__ . '/partials/Header.inc.php');

require_once(__DIR__ . '/partials/Nav.inc.php');
?>

<section class="form-section signup-form-section d-flex justify-content-center align-items-center py-5" id="f-sect">
    <div class="container bg-light shadow rounded-3 mx-4 mt-5" style="width: 580px;">

        <form action="<?= baseurl() ?>/auth/signup" method="POST">
            <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>">
            <div class="row px-1 py-2 p-sm-4">
                <h2 class="py-2">SIGN UP</h2>
                <!-- start error display -->
                <?php Session::warning('SIGNUP-WARNING') ? Session::warning('SIGNUP-WARNING') : '' ?>
                <?php Session::danger('SIGNUP-ERROR') ? Session::danger('SIGNUP-ERROR') : '' ?>
                <?php Session::success('SIGNUP-SUCCESS') ? Session::success('SIGNUP-SUCCESS') : '' ?>
                <!-- end error display -->
                <hr>
                <div class="col-sm-6 col-12 py-2">
                    <input type="fname" value="<?= old_value('firstname') ?>" name="firstname" class="form-control rounded-2" placeholder="First name">
                </div>
                <div class="col-sm-6 col-12 py-2">
                    <input type="lname" value="<?= old_value('lastname') ?>" name="lastname" class="form-control rounded-2"  placeholder="Last name">
                </div>
                <div class="col-12 py-2">
                    <input type="email" value="<?= old_value('email') ?>" name="email" class="form-control rounded-2" placeholder="TRACE Email">
                </div>
                <div class="col-12 py-2">
                    <input type="tel" value="<?= old_value('parent_phone_number') ?>" name="parent_phone_number" class="form-control rounded-2" placeholder="Parent Phone Number" >
                  
                </div>
                <div class="signup-form col-sm-6 col-12 py-2">
                    <input type="password" value="<?= old_value('password') ?>" name="password" class="form-control rounded-2" placeholder="Create Password">
                    <i class="fa-solid fa-eye" id="show-password"></i>
                </div>
                <div class="col-sm-6 col-12 py-2">
                    <input type="password" value="<?= old_value('confirm_password') ?>" name="confirm_password" class="form-control rounded-2" placeholder="Confirm Password">

                </div>
                <div class="col-12 py-2">
                    <select name="grade_level" class="form-select rounded-2">
                        <option value="" selected disabled>Grade Level</option>
                        <option value="g11" disabled>Grade 11</option>
                        <option value="g12">Grade 12</option>
                    </select>
                </div>
                <div class="col-12 py-2">
                    <select name="strand" class="form-select rounded-1 ">
                        <option value="" selected disabled>Strand</option>
                        <option value="abm" disabled>ABM</option>
                        <option value="stem" disabled>STEM</option>
                        <option value="humss">HUMSS</option>
                        <option value="ict" disabled>TVL-ICT</option>
                        <option value="he" disabled>TVL-HE</option>
                        <option value="gas" disabled>GAS</option>
                    </select>
                </div>
                <div class="col-12 py-2 mb-3">
                    <select name="class" class="form-select rounded-1">
                        <option value="" disabled selected>Class</option>
                        <?php
                        // Loop to generate options from 'A' to 'Z'
                        for ($letter = 'A'; $letter <= 'Z'; $letter++) {
                            echo '<option value="' . $letter . '">' . $letter . '</option>';
                            if ($letter === 'Z') {
                                break;
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="d-grid col-12 mx-auto py-2">
                    <button type="submit" class="btn btn-primary ">Sign Up</button>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    const showPassword = document.querySelector("#show-password");
    const passwordField = document.querySelector("#createPassword");

    showPassword.addEventListener("click", function() {
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash", !this.classList.contains("fa-eye"));
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
    })
</script>
<?php require_once(__DIR__ . '/partials/Footer.inc.php') ?>