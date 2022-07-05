$(document).ready(function () {
    $('#sub_category_table').DataTable();
});

//create
$(document).on('click', '#sub_category_create', function () {
    $('#sub_category_form_div').slideToggle();
});


//update
$(document).on('click', '.editSubCategory', function () {
    
    var this_parent_category = $(this).closest('tr').attr('data-parent');
    var sub_category_name  =  $(this).closest('tr').children('td:first').text();
    var data_target = $(this).closest('table').attr('data-target');
    var sub_category_id =  $(this).closest('td').attr('data-subCategoryId');       
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

                updateForm = '<select id="updated_parent" class="swal2-input" name="parent"><option value="">Select Parent Category</option>';
                $.each(response.categories, function (k, v) { 
                     updateForm+='<option value="'+v.id+'" '+(v.id==this_parent_category ? 'selected' : '')+'>'+v.name+'</option>';
                });
                updateForm+='</select>';

                updateForm+='<input type="text" id="sub_category_name" class="swal2-input" value="' + sub_category_name + '" name="name" placeholder="Sub category name">';
                
                Swal.fire({
                    title: 'Edit Sub Category',
                    html: updateForm
                ,
                    confirmButtonText: 'Update',
                    focusConfirm: false,
                    preConfirm: () => {
                        const name = Swal.getPopup().querySelector('#sub_category_name').value
                        const parent = Swal.getPopup().querySelector('#updated_parent').value
                        if (!name) {
                            Swal.showValidationMessage(`Please enter sub category name`)
                        }
                        if(!parent) {
                            Swal.showValidationMessage(`Please select parent category`)
                        }
                        return { name: name , parent: parent }
                    }
                }).then((result) => {
                   if(result.isConfirmed)
                   {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "POST",
                            url: data_target + '/' + sub_category_id + '/update',
                            data: {'_method' : 'PUT','name' : $('#sub_category_name').val() ,'parent':$('#updated_parent').val()},
                            dataType: "json",
                            success: function (response) {
                                if (response.res) {
                                    if (response.data.length) {
                                        tableBody = preapreSubCategoryTable(response.data);
                                        $('#sub_category_body').html(tableBody);
                                        $('#sub_category_table').DataTable();
            
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


//suspend
$(document).on('click','.suspendSubCategory',function(){

    Swal.fire({
        title: 'Are you sure to suspend this sub-category?',
        text: "All the businesses will be suspended!",
        icon: 'warning',
        showCancelButton: true,
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
                data: {'_method' : 'PUT'},
                dataType: "json",
                success: function (response) {
                    if (response.res) {
                        if (response.data.length) {
                            tableBody = preapreSubCategoryTable(response.data);
                            $('#sub_category_body').html(tableBody);
                            $('#sub_category_table').DataTable();

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
