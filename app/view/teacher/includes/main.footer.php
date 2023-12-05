</div>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };

    
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- BOOTSTRAP -->
<script src="<?= baseurl() ?>/public/assets/js/bootstrap.bundle.min.js"></script>
<!-- SCRIPT -->
<script src="<?= baseurl() ?>/public/assets/script.js"></script>
<script>
         $(document).on('click', '.view_StudentData', function(e) {
            e.preventDefault();
            var studentId = $(this).val();
            var url = '<?= baseurl() ?>/teacher/view_student/' + studentId;

            $.ajax({
                type: 'GET',
                url: url,
                success: function(result) {
                    if (result.FetchConditionSuccess) {
                        $('#view_studentName').val(result.FetchData['name']);
                        $('#view_studentEmail').val(result.FetchData['email']);
                        $('#view_studentGrade').val(result.FetchData['grade_level'].replace('g', 'Grade '));
                        $('#view_studentStrand').val(result.FetchData['strand'].toUpperCase());
                        $('#view_studentSection').val(result.FetchData['section']);

                    } else if (result.FetchConditionFailed) {
                        showAlert('warning', result.FetchConditionMessage, '#viewStudentModalAlert');
                    } else {
                        alert("failed to view student data");
                    }
                },
                error: function() {
                    alert('failed to view student data');
                }
            });
        });
</script>
</body>

</html>