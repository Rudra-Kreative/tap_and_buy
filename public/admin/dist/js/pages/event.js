//create
$(document).on('click', '#event_create', function () {
    $('#event_form_div').slideToggle();
    $(this).text($(this).text() == 'Create' ? 'Close' : 'Create');
});


$(document).on('click', '.addImage', function () {
    currTotal = parseInt($('#banner_sequence').attr('data-total'))+1;
    var html = '<div class="images_input_only">' +
        '<div><input type="file" name="image[]"  class="form-control image_file" style="display:inline-block" > ' +
        '<button type="button" class="btn btn-danger removeImage" style="display:inline-block">Remove</button></div>'
        + '<input type="radio" name="banner['+currTotal+']" > Select this as banner' +
        '</div>';

    $('#banner_sequence').attr('data-total',currTotal);
    $('#image_inputs').append(html);

});

$(document).on('click','.removeImage',function () { 
    currTotal = parseInt($('#banner_sequence').attr('data-total'))-1;
    $('#banner_sequence').attr('data-total',currTotal);
    $(this).closest('.images_input_only').remove();
 });

 $(document).on('change','.image_file',function(){

    var filereader = new FileReader();
    var $img=jQuery.parseHTML("<img src=''>");
    filereader.onload = function(){
        $img[0].src=this.result;
    };
    filereader.readAsDataURL(this.files[0]);
    $(".image_preview").append($img);
 });

function showMultiplePreview(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);

        var previewHtml = '<img src="' + src + '" id="image_preview" style="height: 100px; width: 100px;" class="rounded float-right inline mb-4"  alt="...">';
        $('#image_preview').append(previewHtml);
        //preview.style.display = "block";

    }
}