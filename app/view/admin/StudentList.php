<?php
$page_title = "Students";
require_once(__DIR__."/includes/main.header.php")?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <h4 class="text-secondary">Student</h4>
            </div>
        </div>
    </div>
</div>
<?php require_once(__DIR__.'/../partials/Student_list.inc.php') ?>
<?php require_once(__DIR__."/includes/main.footer.php")?>