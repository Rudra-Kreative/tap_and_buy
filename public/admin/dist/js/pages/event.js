//create
$(document).on('click', '#event_create', function () {
    $('#event_form_div').slideToggle();
    $(this).text($(this).text() == 'Create' ? 'Close' : 'Create');
});