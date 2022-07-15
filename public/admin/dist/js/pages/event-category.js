$(document).ready(function () {
    $('#event_category_table').DataTable({ "order": [] });
    $('#event_category_table_length').append('<span style="margin-left: 20px;font-weight:800;">Created By<select name="creatable_type" id="creatable_type"><option value="all">All</option><option value="admin">Admin</option><option value="seller">Sellers</option></select></span>');
});

//create
$(document).on('click', '#event_category_create', function () {
    $('#event_category_form_div').slideToggle();
    $(this).text($(this).text() == 'Create' ? 'Close' : 'Create');
});

$(document).on('change', '#creatable_type', function () {
    if ($(this).val() == 'admin' || $(this).val() == 'seller' || $(this).val() == 'all') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: $('#event_category_table').attr('data-target'),
            data: { 'creatable_type': $(this).val() },
            dataType: "json",
            beforeSend: function () {
                $('#spinner-loader').fadeIn(100);
                $('#spinner-loader-text').html('Fetching...');
            },
            success: function (response) {
                if (response.res) {
                    if (response.data.length) {
                        tableBody = preapreEventCategoryTable(response);
                        $('#event_category_body').html(tableBody);
                        $('#event_category_table').DataTable();


                    }

                }
                else {
                    Toast.fire({
                        icon: 'error',
                        title: response.msg
                    })
                }
            },
            error: function (request, status, error) {
                responses = jQuery.parseJSON(request.responseText);

                console.log(responses.errors);
                console.log(responses.errors.length);

                if (responses.errors) {
                    var errorHtml = '<ul>';
                    $.each(responses.errors, function (key, value) {
                        errorHtml += '<li>' + value + '</li>';
                    });
                    errorHtml += '</ul>';

                    Toast.fire({
                        icon: 'error',
                        title: errorHtml
                    })

                }
            },
            complete: function () {
                $('#spinner-loader').fadeOut(100);
            }
        });
    }
});

//suspend
$(document).on('click', '.suspendEventCategory', function () {

    Swal.fire({
        title: 'Are you sure to suspend this event category?',
        text: "All the events under this category will be suspended!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, suspend it!',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-eventCategoryId') + '/suspend',
                data: {'_method': 'put'},
                dataType: "json",
                beforeSend: function () {
                    $('#spinner-loader').fadeIn(100);
                    $('#spinner-loader-text').html('Suspending...');
                },
                success: function (response) {
                    if (response.res) {
                        if (response.data.length) {
                            tableBody = preapreEventCategoryTable(response);
                            $('#event_category_body').html(tableBody);
                            $('#event_category_table').DataTable();

                            Toast.fire({
                                icon: 'success',
                                title: response.msg
                            })
                        }

                    }
                    else {
                        Toast.fire({
                            icon: 'error',
                            title: response.msg
                        })
                    }
                },
                error: function (request, status, error) {
                    responses = jQuery.parseJSON(request.responseText);

                    if (responses.errors) {
                        var errorHtml = '<ul>';
                        $.each(responses.errors, function (key, value) {
                            errorHtml += '<li>' + value + '</li>';
                        });
                        errorHtml += '</ul>';

                        Toast.fire({
                            icon: 'error',
                            title: errorHtml
                        })

                    }
                },
                complete: function () {
                    $('#spinner-loader').fadeOut(100);
                }

            });

        }
    })

});

//common
function preapreEventCategoryTable(data) {

    tableBody = '';
    auth = data.authorisedId ?? null;
    authType = data.authType ?? null;
    $.each(data.data, function (k, v) {

        tableBody += "<tr>";
        tableBody += "<td>" + v.name + "</td>";
        tableBody += "<td>" + v.creatable.name + "</td>";
        tableBody += "<td>" + v.created_at + "</td>";
        tableBody += "<td data-eventCategoryId='" + v.id + "'>";
        if (authType == 'admin') {

            if ((v.creatable_type == 'App\\Models\\Administrator') && (v.creatable_id == auth)) {
                tableBody += "<i class='fa fa-trash deleteEventCategory' title='Delete'  style='margin-right: 20px;cursor: pointer;' aria-hidden='true'></i>";
                tableBody += '<i class="fa fa-edit editEventCategory" title="Edit" style="cursor: pointer;margin-right: 20px" aria-hidden="true"></i>';

            }
        }
        if(v.is_active == 1)
        {
            tableBody += '<i class="fa fa-ban suspendEventCategory" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>';
        }
        if(v.is_active == 0)
        {
            tableBody += '<i class="fas fa-trash-restore suspendEventCategory" style="color: green;cursor: pointer" title="Reinstate" aria-hidden="true"></i>';
        }
        tableBody += "</td></tr>";
    });

    return tableBody;
}