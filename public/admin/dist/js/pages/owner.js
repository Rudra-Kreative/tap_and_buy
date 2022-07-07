$(document).ready(function () {
    $('#business_owner_table').DataTable({});
});

//create
$(document).on('click', '#business_owner_create', function () {
    $('#business_owner_form_div').slideToggle();
});