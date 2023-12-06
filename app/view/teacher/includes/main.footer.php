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
                        $('#view_studentName').text(result.FetchData['name']);
                        $('#view_studentEmail').text(result.FetchData['email']);
                        $('#view_studentGrade').text(result.FetchData['grade_level'].replace('g', ''));
                        $('#view_studentStrand').text(result.FetchData['strand'].toUpperCase());
                        $('#view_studentSection').text(result.FetchData['section']);
                        $('#view_studentClass').text(result.FetchData['strand_class']);
                        $('#view_studentId').text(result.FetchData['id']);
                        $('#view_studentUniqueId').text(result.FetchData['unique_id']);
                        $('#view_studentDateCreated').text(result.FetchData['created_at']);

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