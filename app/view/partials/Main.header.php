<?php require_once(__DIR__."/Header.inc.php"); ?>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading  text-center py-4 primary-text text-uppercase border-bottom">
        <h3 class="fw-bold primary-text">Trace Early Alert</h3>
        <span class="badge d-block bg-info text-dark mt-3 text-dark">Admin</span>
    </div>
        <div class="list-group list-group-flush my-3">
            <span class="list-category fw-bold">Main</span>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-project-diagram me-2"></i>Configuration</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-user me-2"></i></i>Students</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-school me-2"></i></i>Faculty</a>
            <span class="list-category fw-bold">Early Alert</span>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-clock-rotate-left me-2"></i>History</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-gift me-2"></i>Products</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-comment-dots me-2"></i>Chat</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-map-marker-alt me-2"></i>Outlet</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light shadow bg-light py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-2 m-0">Dashboard</h2>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i>msuarez.f2f@tracecollege.edu.ph
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear me-2"></i>Settings</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-power-off me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>