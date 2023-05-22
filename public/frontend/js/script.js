function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$(document).ready(function () {
    // -----------------------------------
    //          Begin Login Page
    // -----------------------------------

    $('#regEmail').on('input', function () {
        let email = $('#regEmail').val();

        if (!isEmail(email))
        {
            $('#regEmail').addClass('border-danger');
            $('#regEmail').removeClass('border-success');
            $('#emailHelp').text('Please Enter a Valid Email');
        } else {
            $('#regEmail').addClass('border-success');
            $('#regEmail').removeClass('border-danger');
            $('#emailHelp').text('');
        }
    });

    $('#regPass').on('input', function () {
        let pass = $('#regPass').val();

        if (pass.length < 8)
        {
            $('#regPass').addClass('border-danger');
            $('#regPass').removeClass('border-success');
            $('#passHelp').text('Password Length Must be Grater than 8');
        } else {
            $('#regPass').addClass('border-success');
            $('#regPass').removeClass('border-danger');
            $('#passHelp').text('');
        }
    });

    $('.register-form-btn').click(function (e) {
        e.preventDefault();

        $('.login-form-btn > h1').removeClass('text-shadow-light');
        $('.register-form-btn > h1').addClass('text-shadow-light');

        if (!$('.loading').is(':visible')) {
            $('.register').show('d-none');
            $('.login').hide('d-none');
        }
    });
    $('.login-form-btn').click(function (e) {
        e.preventDefault();

        $('.login-form-btn > h1').addClass('text-shadow-light');
        $('.register-form-btn > h1').removeClass('text-shadow-light');

        if (!$('.loading').is(':visible')) {
            $('.login').show('d-none');
            $('.register').hide('d-none');
        }
    });

    $('.login-btn').click(function (e) {
        e.preventDefault();

        let email = $('#loginEmail').val();
        let pass = $('#loginPass').val();

        if (!email || !pass)
        {
            Swal.fire({
                icon: 'error',
                title: 'Login not Successful',
                text: 'Please fill all forms',
            });
            return;
        }

        $('.login').hide();
        $('.loading').show();

        $('#form-login').submit();

    });

    $('.register-btn').click(function (e) {
        e.preventDefault();
        let email = $('#regEmail').val();
        let pass = $('#regPass').val();
        let fname = $('#regFirstName').val();
        let lname = $('#regLastName').val();

        let emailHelp = $('#emailHelp').val();
        let passHelp = $('#passHelp').val();

        if (!email || !fname || !lname || !pass)
        {
            // qalert($('#emailHelp').val())
            Swal.fire({
                icon: 'error',
                title: 'Registration not Successful',
                text: 'Please fill all forms',
            });
            return;
        }


        $('.register').hide();
        $('.loading').show();

        $('#register-form').submit()
    });


    // -----------------------------------
    //           End Login Page
    // -----------------------------------

    // -----------------------------------
    //           End Booking Page
    // -----------------------------------

    // -----------------------------------
    //           End Booking Page
    // -----------------------------------

});
