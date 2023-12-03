<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>
    <?php if (isset($page_title)) {
      echo "$page_title";
    } ?> - TRACE Early Alert
  </title>

  <link rel="stylesheet" href="<?= baseurl() ?>/public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= baseurl()?>/public/assets/main.style.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading  text-center py-4 primary-text text-uppercase border-bottom">
            <h3 class="fw-bold primary-text">Trace Early Alert</h3>
           
        </div>
        <div class="list-group list-group-flush my-3">
            <span class="list-category fw-bold">Main</span>
            <a href="<?= baseurl()?>/admin/dashboard" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="<?= baseurl()?>/admin/configuration" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-project-diagram me-2"></i>Configuration</a>
            <a href="<?= baseurl()?>/admin/student_list" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-user me-2"></i>Student</a>
            <a href="<?= baseurl()?>/admin/faculty_list" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-school me-2"></i>Faculty</a>
            <span class="list-category fw-bold">Early Alert</span>
            <a href="<?= baseurl()?>/admin/send_alert" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-paper-plane me-2"></i>Send Alert</a>
            <a href="<?= baseurl()?>/admin/alert_history" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-clock-rotate-left me-2"></i>History</a>

        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light shadow bg-light py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-4 m-0">Menu</h2>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       <i class="fas fa-user me-2"></i><?= Session::getUserEmail() ?> <span class="badge rounded-pill bg-info text-dark"><?= Session::getUserType()?></span>
                        </a>
                        
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= baseurl()?>/account/profile"><i class="fa-solid fa-address-card me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="<?= baseurl()?>/account/settings"><i class="fa-solid fa-gear me-2"></i>Settings</a></li>
                            <li><a class="dropdown-item" href="<?= baseurl()?>/account/logout"><i class="fas fa-power-off me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>