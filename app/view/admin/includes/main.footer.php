</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?= baseurl() ?>/public/assets/js/bootstrap.bundle.min.js"></script>
<!-- <script src="<?= baseurl() ?>/public/assets/js/main.script.js"></script> -->

<script type="text/javascript">
    $(document).ready(function() {

        // add student data function
        $('#addStudentSubmit').click(function() {
            var data = {
                csrf_token: $('#csrf_token').val(),
                'action': 'insert',
                firstname: $('#fname').val(),
                lastname: $('#lname').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                confirm_password: $('#c_password').val(),
                strand: $('#strand').val(),
                grade_level: $('#grade_level').val()
            };

            console.log(data);
            $.ajax({
                type: 'POST',
                url: '<?= baseurl() ?>/admin/add_student',
                data: {
                    data
                },
                success: function(response) {
                    showAlert();
                    if (response.Success) {
                        $('#student_form')[0].reset();
                        $('#addStudentModal').modal('hide');
                        $('#studentTable').load(location.href + " #studentTable ")
                        showToast('success', 'Inset student data', response.SuccessMessage, '#toastContainer');

                    } else if (response.ValidationError) {
                        showAlert('danger', response.ValidationMessage, '#addStudentModalAlert');
                    } else if (response.TechnicalError) {
                        showAlert('warning', response.TechnicalMessage, '#addStudentModalAlert');
                    } else {
                        showAlert('warning', 'Insert failed. There is no response in ajax. ', '#addStudentModalAlert');
                    }
                },
                error: function() {
                    alert();
                }
            });
        });
        //
    });
    //edit student data 
    $(document).on('click', '.edit_StudentData', function() {
        var studentId = $(this).val();
        var url = '<?= baseurl() ?>/admin/edit_student/' + studentId;

        $.ajax({
            type: "GET",
            url: url,
            success: function(result) {

                if (result.FetchConditionSuccess) {
                    $('#student_id').val(result.FetchData['id']);
                    $('#student_Name').val(result.FetchData['name']);
                    $('#student_Email').val(result.FetchData['email']);
                    $('#student_GradeLevel').val(result.FetchData['grade_level']);
                    $('#student_Strand').val(result.FetchData['strand']);
                    $('#student_Section').val(result.FetchData['section']);
                    $('#student_Class').val(result.FetchData['class']);

                } else if (resut.FetchConditionFailed) {
                    // code the response
                } else {
                    //
                }
            },
            error: function() {
                //
            }
        });
    });
    //save update data function
    $(document).on('submit', '#save_UpdateStudent', function(e) {
        e.preventDefault();

        var formData = new FormData($('#save_UpdateStudent')[0]);

        formData.append("update_student", true);
        // console.log(formData);
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ': ' + pair[1]);
        // }
        var url = '<?= baseurl() ?>/admin/update_student';
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                var res = jQuery.parseJSON(result);
                if (res.UpdateSuccess) {
                    $('#save_UpdateStudent')[0].reset();
                    $('#editStudentModal').modal('hide');
                    showToast('success', 'Update Student Data', res.UpdateSuccessMessage, '#toastContainer');
                } else if (res.UpdateFailed) {
                   
                    showAlert('warning', res.UpdateFailedMessage, '#updateStudentModalAlert');
                } else {
                   alert("error update student")
                }
            },
            error: function() {
                alert("error on update student form");
            }
        });
    });

    //auto hide alert function
    function showAlert(type = '', msg = '', containerId = '') {
        if (!(type == '' && msg == '' && containerId == '')) {
            var alertHtml = ' <div class=" "> <div id="autoFadeAlert" class=" shadow alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                msg + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + '</div> </div>';



            $(containerId).html(alertHtml);

            setTimeout(function() {
                $('#autoFadeAlert').alert('close');
            }, 9000);

        } else {

            $('#autoFadeAlert').alert('close');
        }
    }

    //auto hide toast function
    function showToast(type, title, body, containerId) {
        var newBody = body;
        var toastBody = `
        <div id="liveToast" class="toast show fade hide w-auto" role="alert" aria-live="assertive" aria-atomic="true">
            <div class=" toast-header">
                <strong class="me-auto">${title} </strong>
                <small></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body accordion-collapse "> <i class="fa-solid fa-xl fa-circle-check me-1 mb-2" style="color: #1fbd0a;"></i> ${newBody} </div></div>`;
        $(containerId).html(toastBody);


        setTimeout(function() {
            $('#liveToast').toast('hide');
        }, 6500);
    }
</script>

<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
</script>
</body>

</html>