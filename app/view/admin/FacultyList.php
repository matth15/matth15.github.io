<?php 
    $page_title = "Faculty";
require_once(__DIR__ . "/includes/main.header.php") ?>
<div class="content-wrapper" id="page_heading_title">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <h4 class="text-secondary">Faculty</h4>
            </div>
        </div>
    </div>
</div>
<?php require_once(__DIR__.'/../partials/Faculty_list.php') ?>
<?php require_once(__DIR__ . "/includes/main.footer.php") ?>