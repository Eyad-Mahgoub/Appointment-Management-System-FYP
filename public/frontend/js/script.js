$(document).ready(function () {
    $('.register-btn').click(function (e) {
        e.preventDefault();

        $('.register').removeClass('d-none');
        $('.login').addClass('d-none');
    });
    $('.login-btn').click(function (e) {
        e.preventDefault();

        $('.login').removeClass('d-none');
        $('.register').addClass('d-none');
    });
});
