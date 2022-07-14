$(document).ready(function () {
    $('#category_table').DataTable({ "order": [] });


});


//create
$(document).on('click', '#category_create', function () {
    $('#category_form_div').slideToggle();
    $(this).text($(this).text() == 'Create' ? 'Close' : 'Create');
});

//update
$(document).on('click', '.editCategory', function () {

    Swal.fire({
        title: 'Edit Category',
        html: `<input type="text" id="category_name" class="swal2-input" value="` + $(this).closest('tr').children('td:first').text() + `" name="name" placeholder="Category name">
        `,
        showCancelButton: true,
        showConfirmButton: false,
        allowOutsideClick: false,
        focusConfirm: false
    });

    $('.swal2-actions').prepend(`<button type='button' id='category_update' class="swal2-confirm swal2-styled" style='display: inline-block;'' aria-label=''>Update</button>`);
    $('#category_update').attr('data-target', $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-categoryId') + '/update');
});

$(document).on('click', '#category_update', function () {
    var editedName = $('#category_name').val();
    
    if ((editedName != "") && (editedName !='undefined')) {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: $(this).attr('data-target'),
            data: { '_method': 'PUT', 'name': editedName },
            dataType: "json",
            cache: false,
            beforeSend: function () {
                $('#spinner-loader').fadeIn(100);
                $('#spinner-loader-text').html('Updating...');
            },
            success: function (response) {

                if (response.res) {

                    if (response.data.length) {
                        $('#category_body').html(preapreCategoryTable(response.data));
                        $('#category_table').DataTable();
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
    else{
        Toast.fire({
            icon: 'error',
            title: 'Please enter a category name'
        })
    }
});

//destroy
$(document).on('click', '.deleteCategory', function () {
    Swal.fire({
        title: 'Are you sure to delete this category?',
        text: "All the sub-categories and businesses will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
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
                url: $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-categoryId') + '/delete',
                data: { '_method': 'delete' },
                dataType: "json",
                beforeSend: function () {
                    $('#spinner-loader').fadeIn(100);
                    $('#spinner-loader-text').html('Deleting...');
                },
                success: function (response) {
                    if (response.res) {
                        if (response.data.length) {
                            tableBody = preapreCategoryTable(response.data);
                            $('#category_body').html(tableBody);
                            $('#category_table').DataTable();

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
    })
});


//suspend
$(document).on('click', '.suspendCategory', function () {

    Swal.fire({
        title: 'Are you sure to suspend this category?',
        text: "All the sub-categories and businesses will be suspended!",
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
                url: $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-categoryId') + '/suspend',
                data: {'_method': 'put'},
                dataType: "json",
                beforeSend: function () {
                    $('#spinner-loader').fadeIn(100);
                    $('#spinner-loader-text').html('Suspending...');
                },
                success: function (response) {
                    if (response.res) {
                        if (response.data.length) {
                            tableBody = preapreCategoryTable(response.data);
                            $('#category_body').html(tableBody);
                            $('#category_table').DataTable();

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
function preapreCategoryTable(data) {
    tableBody = '';
    $.each(data, function (k, v) {

        tableBody += "<tr>";
        tableBody += "<td>" + v.name + "</td>";
        tableBody += "<td>" + v.created_by + "</td>";
        tableBody += "<td>" + v.created_at + "</td>";
        tableBody += "<td data-categoryId='" + v.id + "'>";
        tableBody += "<i class='fa fa-trash deleteCategory' title='Delete'  style='margin-right: 20px;cursor: pointer;' aria-hidden='true'></i>";
        tableBody += '<i class="fa fa-edit editCategory" title="Edit" style="cursor: pointer;margin-right: 20px" aria-hidden="true"></i>';
        tableBody += '<i class="fa fa-ban suspendCategory" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>';
        tableBody += "</td></tr>";
    });

    return tableBody;
}


