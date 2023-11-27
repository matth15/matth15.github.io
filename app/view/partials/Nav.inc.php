<nav class="navbar navbar-expand-lg sticky-top bg-body-tertiary position-fixed w-100">
  <div class="container">
    <a href="<?= baseurl()?>/home" class="navbar-brand">
      <img src="<?= baseurl()?>/public/assets/images/trace-college-logo.png" alt="" style="width: 35px" />
      <span class="hidden-on-small-screens">TRACE</span>
      <span>Early Alert</span> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= baseurl() ?>/home">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown">About</a>
          <ul class="dropdown-menu dropdown-menu-dark text-light ">
            <li><a href="<?= baseurl() ?>/home?id=about" class="dropdown-item">About</a></li>
            <li>
              <hr class="dropdown-divider ">
            </li>
            <li><a href="<?= baseurl() ?>/home?id=mv" class="dropdown-item">Mission & Vision</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?= baseurl() ?>/home?id=contact" class="nav-link">Contact</a>
        </li>
        <li class="nav-item">
          <a href="<?= baseurl() ?>/home?id=team" class="nav-link">Team</a>
        </li>
      </ul>

      <div class="d-flex flex-lg-row flex-md-column flex-sm-row  ">
        <div class="col-lg-6 col-md-12 py-md-1 py-lg-0">
          <a href="<?= baseurl()?>/auth/login" class="btn btn-dark btn-sm shadow-sm">LOG IN</a>
        </div>
        <div class="col-lg-12 py-lg-0 py-md-1 ms-2 ms-md-0 ">
          <a href="<?= baseurl()?>/auth/signup" class="btn btn-dark btn-sm shadow-sm">SIGN UP</a>
        </div>
      </div>
    </div>
  </div>
</nav>