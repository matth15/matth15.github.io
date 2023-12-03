function simulateLoading(){
    const loginBtn = document.getElementById('loginBtn');
    loginBtn.disabled=true;
    loginBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';

    setTimeout(() => {
        loginBtn.innerHTML='Login';
        loginBtn.disabled=false;
    },2400);
}

//ajax add student form
$(document).ready(function(){
    $('#addStudentModal').click(function(e){
        $('#student_form')[0].reset();
        $('.modal-title').text("Add Student Data");
        
        // get input data
        var firstName = $('#fname').val();
        var lastName = $('lname').val();
        var email = $('email').val();
        var password = $('password').val();
        var confirm_password = $('c_password').val();
        var strand = $('strand').val();
        var grade_level = $('grade_level').val();
        var section = $('section').val(); 

        $.ajax({
            url: 'admin/student_list',
            type: 'POST',
            data: {
                firstname : firstName,
                lastname : lastName,
                email : email,
                password : password,
                confirm_password : confirm_password,
                strand : strand,
                grade_level : grade_level,
                section : section
            },

            error: function(){
                alert(error);
            }
        });
    });
});

function showAlert(type, msg){
    var alertHtml = '<div class="alert alert-'+type+'" alert-dismissible fade show role="alert">'
    +msg+ '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+'</div>';

    $('$alertContainer').html(alertHtml);
}






