<?php

$page_title = "Home";
require_once __DIR__ . '/partials/Header.inc.php'; //HEADER
?>
<header class="header-site d-flex flex-column justify-content-center" id="home">
  <?php
  require_once(__DIR__ . '/partials/Nav.inc.php') //NABAR
  ?>
  <div class="container pt-5 ">
    <div class="col-12 col-lg-7">
      <h1 class="fr p-0">
        <strong><span>TRACE</span> College Early Alert</strong>
      </h1>
      <p class="fr py-4 ">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
        ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
        aliquip ex ea commodo consequat. Duis aute irure dolor in
        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
        culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
  </div>
</header> <!-- HEADER SITE -->

<main>
  <section class="about bg-light" id="about">
    <div class="container">
      <div class="row pt-5">
        <div class="d-block d-lg-flex">
          <div class="about-content col-12 col-lg-6 d-flex flex-column justify-content-center ">
            <h2 class="mb-5 mb-md-5 fs-1">
              <strong>About</strong>
            </h2>
            <p class="p-txt-about"> <!--  -->
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
              do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco
              laboris nisi ut aliquip ex ea commodo consequat. Duis aute
              irure dolor in reprehenderit in voluptate velit esse cillum
              dolore eu fugiat nulla pariatur. Excepteur sint occaecat
              cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum.
            </p>
          </div>
          <div class=" col-12 col-lg-6 pt-lg-5 d-flex justify-content-center">
            <img class="img-about img-fluid" src="/public/assets/images/trace-ea-logo-image.png" alt="TRACE College Logo" style="width: 288px" />
          </div>
        </div>
      </div>
    </div>
  </section> <!--ABOUT-->
  <section class="bg-light pb-4" id="mv">
    <div class="container pb-5">
      <div class="row py-4">
        <div class="col-lg-6 col-md-12 p-4">
          <div class="mv-content shadow rounded-3 p-4 pb-4 px-5 pt-5">
            <h5 class="mv-text rounded-2 py-2 px-3 mb-5 mb-md-4">Mission</h5>
            <p class="p-txt ">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
              do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco
              laboris nisi ut aliquip ex ea commodo consequat. Duis aute
              irure dolor in reprehenderit in voluptate velit esse cillum
              dolore eu fugiat nulla pariatur. Excepteur sint occaecat
              cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum.
            </p>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 p-4">
          <div class="mv-content shadow rounded-3 pb-4 px-5 pt-5">
            <h5 class="mv-text rounded-2 py-2 px-3 mb-5 mb-md-4">Vision</h5>
            <p class="p-txt">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
              do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco
              laboris nisi ut aliquip ex ea commodo consequat. Duis aute
              irure dolor in reprehenderit in voluptate velit esse cillum
              dolore eu fugiat nulla pariatur. Excepteur sint occaecat
              cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section> <!-- MISSION & VISION -->

  <!-- <section class="pb-5 bg-light" id="services">
       <div class="container">
       <div class="row g-4 py-5">
          <h2 class="text-center mb-4 mb-md-5 fs-2"><strong>Services</strong></h2>
          <div class="col-xl-6 col-md-12 col-lg-6">
            <div class="card card-service1 bg-danger text-light p-4 shadow ">
              <div class="card-body">
                <h5 class="card-title text-center border-bottom border-1 pb-4">
                  <strong> Services 1 </strong>
                </h5>
                <p class="p-txt card-text my-4">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                  irure dolor in reprehenderit in voluptate velit esse cillum
                  dolore eu fugiat nulla pariatur.
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-md-12 col-lg-6">
            <div class="card card-service2 bg-danger p-4 shadow text-light">
              <div class="card-body">
                <h5 class="card-title text-center border-bottom border-1 pb-4">
                  <strong> Services 2 </strong>
                </h5>
                <p class="p-txt card-text my-4">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                  irure dolor in reprehenderit in voluptate velit esse cillum
                  dolore eu fugiat nulla pariatur.
                </p>
              </div>
            </div>
          </div>
        <div class="col-xl-6 col-lg-6 offset-lg-3">
            <div class=" card-service3 card shadow bg-danger text-light p-4" >
              <div class="card-body">
                <h5 class="card-title text-center border-bottom border-1 pb-4">
                  <strong> Services 3 </strong>
                </h5>
                <p class="p-txt card-text my-4">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                  irure dolor in reprehenderit in voluptate velit esse cillum
                  dolore eu fugiat nulla pariatur.
                </p>
              </div>
            </div>
          </div>
        </div>
       </div>
      </section> SERVICES -->

  <section class="contact-section text-light" id="contact">

  </section> <!-- CONTACT -->
</main>
<script>
  function navigateToSection(sectionId) {
    // Access the section with the specified id
    var section = document.getElementById(sectionId);

    // Scroll to the section
    if (section) {
      section.scrollIntoView({
        behavior: 'smooth' // Optional: Add smooth scrolling effect
      });
    }
  }
</script>
<?php
require_once(__DIR__ . '/partials/Footer.inc.php');
?>