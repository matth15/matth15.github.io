<?php
$page_title = "Students";
require_once(__DIR__."/includes/main.header.php")?>
<div class="content-wrapper" id="page_heading_title">
   <div class="container">
    <div class="row">
        <div class="col">
            <h4>Student</h4>
        </div>
    </div>
   </div>
</div>
<?php require_once(__DIR__.'/../partials/Student_list.inc.php') ?>
<?php require_once(__DIR__."/includes/main.footer.php")?>