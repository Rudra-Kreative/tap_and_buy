$(document).ready(function () {
    $('#sub_category_table').DataTable();
});

//create
$(document).on('click', '#sub_category_create', function () {
    $('#sub_category_form_div').slideToggle();
});


//update
$(document).on('click', '.editSubCategory', function () {
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        type: 'GET',
        url: '/administrator/category/',
        data: {'onlyData':true},
        dataType: 'json',
        async : true,
        success: function (response) {
            
            if(response.res)
            {
                console.log($(this).closest('td').parent('tr').attr('data-parent'))
                console.log($(this).closest('tr').attr('data-parent'));
                
                updateForm = '<select name="parent"><option value="">Select Parent Category</option>';
                $.each(response.categories, function (k, v) { 
                     updateForm+='<option value="'+v.id+'" >'+v.name+'</option>';
                });
                updateForm+='</select>';

                updateForm+='<input type="text" id="sub_category_name" class="swal2-input" value="' + $(this).closest('tr').children('td:first').text() + '" name="name" placeholder="Username"';

                Swal.fire({
                    title: 'Edit Sub Category',
                    html: updateForm
                ,
                    confirmButtonText: 'Update',
                    focusConfirm: false,
                    preConfirm: () => {
                        const name = Swal.getPopup().querySelector('#sub_category_name').value
                        const parent = Swal.getPopup().querySelector('#parent').value
                        if (!name) {
                            Swal.showValidationMessage(`Please enter sub category name`)
                        }
                        if(!parent) {
                            Swal.showValidationMessage(`Please select sub category`)
                        }
                        return { name: name }
                    }
                })

            }
        }
    });

});


//delete
$(document).on('click', '.deleteSubCategory', function () {
    Swal.fire({
        title: 'Are you sure to delete this sub category?',
        text: "All the businesses will be deleted!",
        icon: 'warning',
        showCancelButton: true,
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
                'return' : false
            };

             __callCategory(payload);
            
            
        }

    })
});


//common

function __callCategory(__e)
{
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
        async : true,
        success: function (response) {
            
            if(__e.return)
            {
               
                return response;
            }
            else{
                if (response.res) {
                    preapreSubCategoryTable(response.data);
                    Swal.fire(
                        'Succeed!',
                        response.msg,
                        'success'
                    )
                }
    
                else {
                    Swal.fire(
                        'Failed!',
                        response.msg,
                        'error'
                    )
                }
            }
        }
    });
}


function preapreSubCategoryTable(data) {
    tableBody = '';
    $.each(data, function (k, v) {

        tableBody += "<tr data-parent='"+v.parent.id+"'>";
        tableBody += "<td>" + v.name + "</td>";
        tableBody += "<td>" + v.parent.id + "</td>";
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
