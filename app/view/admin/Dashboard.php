<?php
$page_title = "Dashboard";

require_once(__DIR__ . "/includes/main.header.php");
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <h4 class="text-secondary">Dashboard</h4>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 mb-3">
                <div class="card shadow py-1 h-100 border-danger border-2 ">
                    <div class="card-body">
                        <div class="row">
                            <p class="d-flex align-items-center"><i class="fa fa-users fa-2x text-secondary me-2 "></i>Student</p>
                            <div class="col-12 d-flex justify-content-center">

                                <h2><?= $studentCount ?></h2>
                            </div>
                            <a href="<?= baseurl() ?>/admin/student_list" class="card-view text-center">View</p></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-3">
                <div class="card shadow py-1 h-100 border-danger border-2">
                    <div class="card-body">
                        <div class="row">
                            <p class="d-flex align-items-center"><i class="fa-solid fa-school fa-2x text-secondary me-2"></i> Faculty</p>
                            <div class="col-12 d-flex justify-content-center">
                                <h2><?= $teacherCount ?></h2>
                            </div>
                            <a href="<?= baseurl() ?>/admin/faculty_list" class="card-view text-center">View</p></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-3">
                <div class="card shadow py-1 h-100 border-danger border-2">
                    <div class="card-body ">
                        <div class="row">
                            <p class="d-flex align-items-center"><i class="fa fa-users fa-2x text-secondary me-2 "></i>History</p>
                            <div class="col-12 d-flex justify-content-center">
                                <h2>0</h2>
                            </div>
                            <a href="<?= baseurl() ?>/admin/alert_list" class="card-view text-center">View</p></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-3">
                <div class="card shadow py-1 h-100 border-danger border-2">
                    <div class="card-body">
                        <div class="row">
                            <p class="d-flex align-items-center"><i class="fa fa-users fa-2x text-secondary me-2 "></i></p>
                            <div class="col-12 d-flex justify-content-center">
                                <h2>0</h2>
                            </div>
                            <a href="<?= baseurl() ?>" class="card-view text-center">View</p></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php if (isset($_SESSION['LOGIN-SUCCESS']) && $_SESSION['LOGIN-SUCCESS']) : Session::successToast("LOGIN-SUCCESS"); ?>
    <!-- SHOW TOAST -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myToast = new bootstrap.Toast(document.getElementById('myToast'));
            myToast.show();
        });
    </script>
<?php
endif;
require_once(__DIR__ . "/includes/main.footer.php"); ?>