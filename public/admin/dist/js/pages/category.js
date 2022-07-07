$(document).ready(function () {
    $('#category_table').DataTable();
});


//create
$(document).on('click', '#category_create', function () {
    $('#category_form_div').slideToggle();
});

//update
$(document).on('click', '.editCategory', function () {
    //console.log($(this).closest('tr').children('td:first').text());

    Swal.fire({
        title: 'Edit Category',
        html: `<input type="text" id="category_name" class="swal2-input" value="` + $(this).closest('tr').children('td:first').text() + `" name="name" placeholder="Category name">
    `,
        confirmButtonText: 'Update',
        focusConfirm: false,
        preConfirm: () => {
            const name = Swal.getPopup().querySelector('#category_name').value

            if (!name) {
                Swal.showValidationMessage(`Please enter category name`)
            }
            return { name: name }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-categoryId') + '/update',
                data: { '_method': 'PUT', 'name': $('#category_name').val() },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.res) {

                        if (response.data.length) {
                            $('#category_body').html(preapreCategoryTable(response.data));
                            $('#category_table').DataTable();
                            Swal.fire(
                                'Succeed!',
                                response.msg,
                                'success'
                            )
                        }

                    }
                    else {
                        Swal.fire(
                            'Failed!',
                            response.msg,
                            'error'
                        )
                    }
                }
            });
        }
    })

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
        confirmButtonText: 'Yes, delete it!'
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
                success: function (response) {
                    if (response.res) {
                        if (response.data.length) {
                            tableBody = preapreCategoryTable(response.data);
                            $('#category_body').html(tableBody);
                            $('#category_table').DataTable();

                            Swal.fire(
                                'Succeed!',
                                response.msg,
                                'success'
                            )
                        }

                    }
                    else {
                        Swal.fire(
                            'Failed!',
                            response.msg,
                            'error'
                        )
                    }
                }
            });

        }
    })
});


//suspend
$(document).on('click','.suspendCategory',function(){

    Swal.fire({
        title: 'Are you sure to suspend this category?',
        text: "All the sub-categories and businesses will be suspended!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, suspend it!'
    }).then((result) => {
        if (result.isConfirmed) {

            let payload = {
                'method' : 'POST',
                'target' : $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-categoryId') + '/suspend',
                'data' : {},
                'type' : 'json'
            };
        
            response = __call(payload);
            tableBody = preapreCategoryTable(response.data);
            $('#category_body').html(tableBody);
            $('#category_table').DataTable();

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
        tableBody += '<i class="fa fa-ban" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>';
        tableBody += "</td></tr>";
    });

    return tableBody;
}


