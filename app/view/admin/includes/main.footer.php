</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?= baseurl() ?>/public/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= baseurl() ?>/public/assets/main.script.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

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
            $.ajax({
                type: 'POST',
                url: '<?= baseurl() ?>/admin/add_student',
                DataType: 'json',
                data: {
                    data
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.SuccessMessage, '#studentTableAlert');


                    } else if (response.ValidationError) {
                        // showAlert('danger', response.ValidationMessage, '#addStudentModalAlert');
                        $('#addStudentModal').modal('hide');
                        showToast('success', 'Insert Student Data', "Add student data successfully!", "#toastContainer");
                    } else if (response.TechnicalError) {
                        showAlert('alert', 'Insert failed. There was an error inside a system.');
                    }
                },
                error: function(error) {
                    showAlert('alert', 'Submit failed. There was an error inside a system.', '$addStudentModalAlert');
                }
            });
        });
        //



    });
    var alertTimeout;
    //auto hide alert function
    function showAlert(type = '', msg = '', containerId = '') {
        if (!(type == '' && msg == '' && containerId == '')) {
            var alertHtml = '<div id="autoFadeAlert" class="shadow alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                msg + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + '</div>';

            clearTimeout(alertTimeout);

            $(containerId).html(alertHtml);
            setTimeout(function() {

                $('#autoFadeAlert').alert('close');
            }, 2500);
        } else {

            $('#autoFadeAlert').alert('close');
        }
    }
    //
    function showToast(type, title, body, containerId) {
    const toastId = 'liveToast_' + Date.now();
    var toastBody = `
        <div id="${toastId}" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="bg-${type} text-white toast-header">
                <strong class="me-auto">${title}</strong>
                <small class="timeAgo">Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-white bg-${type}">${body}</div>
        </div>
    `;

    $(containerId).html(toastBody);

    const timestamp = Date.now();

    // Update the "X mins ago" text every minute
    const intervalId = setInterval(function () {
        updateTimestamp($(`#${toastId} .timeAgo`), timestamp);
    }, 60000);

    setTimeout(function () {
        // Hide the toast after 30 seconds
        $(`#${toastId}`).toast('hide');
        clearInterval(intervalId); // Stop the interval when hiding the toast
    }, 30000);

    $(`#${toastId}`).toast('show');
}

function updateTimestamp(element, timestamp) {
    const currentTime = Date.now();
    const minutesAgo = Math.floor((currentTime - timestamp) / 60000);

    console.log('Timestamp:', timestamp);
    console.log('Current Time:', currentTime);
    console.log('Minutes Ago:', minutesAgo);

    element.text(minutesAgo === 0 ? 'Just now' : `${minutesAgo} mins ago`);
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