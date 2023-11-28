</div>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
</script>
<!-- BOOTSTRAP -->
<script src="<?= baseurl() ?>/public/assets/js/bootstrap.bundle.min.js"></script>
<!-- SCRIPT -->
<script src="<?= baseurl() ?>/public/assets/script.js"></script>
</body>

</html>