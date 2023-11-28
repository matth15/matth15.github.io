<?php
$page_title = "Dashboard";

require_once(__DIR__ . "/includes/main.header.php");
?>
<div class="container">
    <h2><strong>testing</strong></h2>
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