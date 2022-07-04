$(document).ready(function () {
    
    $('#business_owner_table').DataTable();

    $(document).on('click','#user-direct',function(){
        swal.fire({
            title: 'Select',
            html: "Redirect me to:" +
                '<br>'  +
                '<button type="button" role="button" tabindex="0" class="redirectOwner swal2-styled swal2-default-outline" style="display: inline-block; background-color: rgb(48, 133, 214);">' + 'Owner' + '</button>' +
                '<button type="button" role="button" tabindex="0" class="redirectClient swal2-styled swal2-default-outline" style="display: inline-block; background-color: rgb(48, 133, 214);">' + 'Client' + '</button>',
            showCancelButton: false,
            showConfirmButton: false
        });
    });

    $(document).on('click','.redirectOwner',function(){
        $(window).attr('location','/administrator/user/owner')
    });
    $(document).on('click','.redirectClient',function(){
        $(window).attr('location','/administrator/user/client')
    });
    
});

