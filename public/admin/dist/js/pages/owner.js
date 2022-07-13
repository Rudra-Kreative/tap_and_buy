$(document).ready(function () {
    $('#business_owner_table').DataTable({});
});

//create
$(document).on('click', '#business_owner_create', function () {
    $('#business_owner_form_div').slideToggle();
    $(this).text($(this).text() == 'Register' ? 'Close' : 'Register');
});

//edit
$(document).on('click', '.editOwner', function () {

    var id = $(this).closest('td').attr('data-ownerid');
    var dataTarget = $(this).closest('table').attr('data-target');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: $(this).closest('table').attr('data-target') + '/' + $(this).closest('td').attr('data-ownerid') + '/edit',
        data: {},
        dataType: "json",
        success: function (response) {

            if (response.success) {
                let reneredHtml = $('#business_owner_form_div').clone();
                Swal.fire({
                    title: 'Edit Owner',
                    html: `<input type="text" id="category_name" class="swal2-input" value="" name="name" placeholder="Category name">
                `,
                    confirmButtonText: 'Update',
                    focusConfirm: false,
                    showCancelButton: true,
                    allowOutsideClick: false,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        const name = Swal.getPopup().querySelector('#name').value
                        const email = Swal.getPopup().querySelector('#email').value
                        const phone = Swal.getPopup().querySelector('#phone').value
                        const location = Swal.getPopup().querySelector('#location').value
                        const occupation = Swal.getPopup().querySelector('#occupation').value

                        if (!name) {
                            Swal.showValidationMessage(`Please enter business owner name`)
                        }
                        if (!email) {
                            Swal.showValidationMessage(`Please enter an unique email`)
                        }
                        if (!phone) {
                            Swal.showValidationMessage(`Please enter phone number`)
                        }
                        if (!location) {
                            Swal.showValidationMessage(`Please enter owner's location`)
                        }
                        if (!occupation) {
                            Swal.showValidationMessage(`Please enter owner's occupation`)
                        }
                        return { name: name , email:email,phone:phone , location:location , occupation:occupation }
                    }
                }).then((result) => {
                    if(result.isConfirmed)
                    {
                        var formData = new FormData();
                        $.each($('#editFormOwner').serializeArray(), function(i, field) {
                            
                            formData.append(field.name , field.value);
                        });

                        
                        var files = $('#editedImage')[0].files;
                        
                        if(files[0])
                        {
                            formData.append('image' , files[0]);
                        }
                        
                        $('.swal2-loader').fadeIn(100);
                        $.ajax({
                            type: "POST",
                            url: dataTarget+'/'+id+'/update',
                            data: formData,
                            dataType: "json",
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                tableBody = preapreOwnerTable(response.data);
                                $('#business_owner_body').html(tableBody);
                                $('#business_owner_table').DataTable();
                                $('.swal2-loader').fadeOut(100);
                            }
                        });
                    }
                });
                $('#swal2-html-container').html(reneredHtml);
                $('#swal2-html-container #file-dp-1-preview').attr('id', 'file-dp-2-preview');
                $('#swal2-html-container #name').val(response.data.name);
                $('#swal2-html-container #file-dp-2-preview').attr('src', (response.data.image_path ? '/' + response.data.image_path : 'https://i.pravatar.cc/100?u=' + id));
                $('#swal2-html-container #email').val(response.data.email);
                $('#swal2-html-container #phone').val(response.data.phone);
                $('#swal2-html-container #location').val(response.data.location);
                $('#swal2-html-container #occupation').val(response.data.occupation);
                $('#swal2-html-container #image').removeAttr("onchange");
                $('#swal2-html-container #image').attr("id", 'editedImage');
                $('#swal2-html-container form').attr("action", '');
                $('#swal2-html-container form').attr('id','editFormOwner');


                $("#swal2-html-container #timezone option[value='" + response.data.timezone + "'").prop('selected', true);
                $('#swal2-html-container .owner_form_button').html('');
                $('#swal2-html-container #business_owner_form_div').fadeIn(100);


                $('#swal2-html-container #editedImage').bind('change', function () {

                    $('#file-dp-2-preview').fadeOut(100);
                    $('#file-dp-2-preview').removeAttr('src');
                    var src = URL.createObjectURL(document.getElementById('editedImage').files[0]);
                    var preview = document.getElementById("file-dp-2-preview");
                    preview.src = src;
                    $('#file-dp-2-preview').fadeIn(500);

                })


            }
            else {
                alert(response.msg);
            }
        }
    });
});


//common
function preapreOwnerTable(data) {
    tableBody = '';
    $.each(data, function (k, v) {

        tableBody += "<tr>";
        tableBody += "<td style='text-align:center'>" + "<img class='rounded-circle' style='width: 50px;height: 50px;' src='"+((v.image_path != '' || v.image_path != null) ? v.image_path : 'https://i.pravatar.cc/50?u='+v.id)+"' alt=''></img><p>" + v.name + "</p></td>";
        tableBody += "<td>" + v.name + "</td>";
        tableBody += "<td>" + v.email + "</td>";
        tableBody += "<td>" + v.phone + "</td>";
        tableBody += "<td>" + v.location + "</td>";
        tableBody += "<td>" + v.occupation + "</td>";
        tableBody += "<td>" + v.businesses_count + "</td>";
        tableBody += "<td>" + v.products_count + "</td>";
        tableBody += "<td data-ownerId='" + v.id + "'>";
        tableBody += "<i class='fa fa-trash deleteOwner' title='Delete'  style='margin-right: 5px;cursor: pointer;' aria-hidden='true'></i>";
        tableBody += '<i class="fa fa-edit editOwner" title="Edit" style="cursor: pointer;margin-right: 5px" aria-hidden="true"></i>';
        tableBody += '<i class="fa fa-ban" title="Suspend" style="cursor: pointer" aria-hidden="true"></i>';
        tableBody += "</td></tr>";
    });

    return tableBody;
}
