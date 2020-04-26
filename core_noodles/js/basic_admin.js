$(document).ready(function() {
    $('.mobile button').click(function() {
        $(this).toggleClass('expanded').siblings('div').slideToggle();
    });
});
