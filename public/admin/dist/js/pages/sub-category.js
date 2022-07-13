$(document).ready(function () {
    $('#sub_category_table').DataTable({ "order": [] });
});

//create
$(document).on('click', '#sub_category_create', function () {
    $('#sub_category_form_div').slideToggle();
});


//update
$(document).on('click', '.editSubCategory', function () {

    var this_parent_category = $(this).closest('tr').attr('data-parent');
    var sub_category_name = $(this).closest('tr').children('td:first').text();
    var data_target = $(this).closest('table').attr('data-target');
    var sub_category_id = $(this).closest('td').attr('data-subCategoryId');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        type: 'GET',
        url: '/administrator/category/',
        data: { 'onlyData': true },
        dataType: 'json',
        async: true,
        success: function (response) {

            if (response.res) {

                updateForm = '<select id="updated_parent" class="swal2-input" name="parent"><option value="">Select Parent Category</option>';
                $.each(response.categories, function (k, v) {
                    updateForm += '<option value="' + v.id + '" ' + (v.id == this_parent_category ? 'selected' : '') + '>' + v.name + '</option>';
                });
                updateForm += '</select>';

                updateForm += '<input type="text" id="sub_category_name" class="swal2-input" value="' + sub_category_name + '" name="name" placeholder="Sub category name">';

                Swal.fire({
                    title: 'Edit Sub Category',
                    html: updateForm,
                    showCancelButton: true,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    focusConfirm: false,
                    preConfirm: () => {
                        return false;
                    }
                });

                $('.swal2-actions').prepend(`<button type='button' id='sub_category_update' class="swal2-confirm swal2-styled" style='display: inline-block;'' aria-label=''>Update</button>`);
                $('#sub_category_update').attr('data-target', data_target + '/' + sub_category_id + '/update');

            }
        }
    });

});


$(document).on('click', '#sub_category_update', function () {
    var subCatName = $('#sub_category_name').val();
    var parentCat = $('#updated_parent').val();

    if (subCatName != "" && parentCat != "") {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: $(this).attr('data-target'),
            data: { '_method': 'PUT', 'name': subCatName, 'parent': parentCat },
            dataType: "json",
            beforeSend: function () {
                $('#spinner-loader').fadeIn(100);
                $('#spinner-loader-text').html('Updating...');
            },
            success: function (response) {
                if (response.res) {
                    if (response.data.length) {
                        tableBody = preapreSubCategoryTable(response.data);
                        $('#sub_category_body').html(tableBody);
                        $('#sub_category_table').DataTable();

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

    else {
        Toast.fire({
            icon: 'error',
            title: 'Please enter all the mandatory field'
        })
    }
});


//delete
$(document).on('click', '.deleteSubCategory', function () {
    Swal.fire({
        title: 'Are you sure to delete this sub category?',
        text: "All the businesses will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {
            let payload = {
                'method': 'POST',
                'target': $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-subCategoryId') + '/delete',
                'data': { '_method': 'delete' },
                'type': 'json',
                'return': false
            };

            __callCategory(payload);


        }

    })
});


//suspend
$(document).on('click', '.suspendSubCategory', function () {

    Swal.fire({
        title: 'Are you sure to suspend this sub-category?',
        text: "All the businesses will be suspended!",
        icon: 'warning',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, suspend it!'
    }).then((result) => {
        if (result.isConfirmed) {

            var data_target = $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-subCategoryId') + '/suspend';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: data_target,
                data: { '_method': 'PUT' },
                dataType: "json",
                beforeSend: function () {
                    $('#spinner-loader').fadeIn(100);
                    $('#spinner-loader-text').html('Deleting...');
                },
                success: function (response) {
                    if (response.res) {
                        if (response.data.length) {
                            tableBody = preapreSubCategoryTable(response.data);
                            $('#sub_category_body').html(tableBody);
                            $('#sub_category_table').DataTable();

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

//common

function __callCategory(__e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: __e.method ?? '',
        url: __e.target ?? '',
        data: __e.data ?? '',
        dataType: __e.type ?? '',
        async: true,
        caches: false,
        beforeSend: function () {
            $('#spinner-loader').fadeIn(100);
            $('#spinner-loader-text').html('Deleting...');
        },
        success: function (response) {

            if (__e.return) {

                return response;
            }
            else {
                if (response.res) {
                    preapreSubCategoryTable(response.data);
                    Toast.fire({
                        icon: 'success',
                        title: response.msg
                    })
                }

                else {
                    Toast.fire({
                        icon: 'error',
                        title: response.msg
                    })
                }
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


function preapreSubCategoryTable(data) {
    tableBody = '';
    $.each(data, function (k, v) {

        tableBody += "<tr data-parent='" + v.parent.id + "'>";
        tableBody += "<td>" + v.name + "</td>";
        tableBody += "<td>" + v.parent.name + "</td>";
        tableBody += "<td>" + v.created_by + "</td>";
        tableBody += "<td>" + v.created_at + "</td>";
        tableBody += "<td data-subCategoryId='" + v.id + "'>";
        tableBody += "<i class='fa fa-trash deleteSubCategory' title='Delete'  style='margin-right: 20px;cursor: pointer;' aria-hidden='true'></i>";
        tableBody += '<i class="fa fa-edit editSubCategory" title="Edit" style="cursor: pointer;margin-right: 20px" aria-hidden="true"></i>';
        tableBody += '<i class="fa fa-ban" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>';
        tableBody += "</td></tr>";
    });

    $('#sub_category_body').html(tableBody);
    $('#sub_category_table').DataTable();

}
