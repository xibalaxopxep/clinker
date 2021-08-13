
// Select with search
if ($('.select-search').length) {
    $('.select-search').select2();
}

// Initialize
if ($('.touchspin').length) {
    $('.touchspin').TouchSpin({
        min: 0,
        max: 1000000000,
    });

// Trigger value change when +/- buttons are clicked
    $('.touchspin').on('touchspin.on.startspin', function () {
        $(this).trigger('blur');
    });
}
if ($('.tokenfield').length) {
    // Basic initialization
    $('.tokenfield').tokenfield();
}
if ($('.pickadate').length) {
    // Basic options
    $('.pickadate').pickadate({
        format: 'dd/mm/yyyy',
        formatSubmit: 'yyyy-mm-dd'
    });
}
if ($('.ckeditor').length) {
    if (typeof (CKEDITOR) !== 'undefined' && $('#content').length)
        CKEDITOR.replace('content');
    if (typeof (CKEDITOR) !== 'undefined' && $('#description').length)
        CKEDITOR.replace('description');
}
// Default initialization
if ($('.form-check-input-styled').length) {
    $('.form-check-input-styled').uniform();
// Initialize
    var validator = $('.form-validate-jquery').validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-invalid-label',
        successClass: 'validation-valid-label',
        validClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        success: function (label) {
            label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
        },

        // Different components require proper error label placement
        errorPlacement: function (error, element) {

            // Unstyled checkboxes, radios
            if (element.parents().hasClass('form-check')) {
                error.appendTo(element.parents('.form-check').parent());
            }

            // Input with icons and Select2
            else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            }

            // Input group, styled file input
            else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }

            // Other elements
            else {
                error.insertAfter(element);
            }
        },
        rules: {
            password: {
                minlength: 5
            },
            repeat_password: {
                equalTo: '#password'
            },
            email: {
                email: true
            },
            repeat_email: {
                equalTo: '#email'
            },
            minimum_characters: {
                minlength: 10
            },
            maximum_characters: {
                maxlength: 10
            },
            minimum_number: {
                min: 10
            },
            maximum_number: {
                max: 10
            },
            number_range: {
                range: [10, 20]
            },
            url: {
                url: true
            },
            date: {
                date: true
            },
            date_iso: {
                dateISO: true
            },
            numbers: {
                number: true
            },
            digits: {
                digits: true
            },
            creditcard: {
                creditcard: true
            },
            basic_checkbox: {
                minlength: 2
            },
            styled_checkbox: {
                minlength: 2
            },
            switchery_group: {
                minlength: 2
            },
            switch_group: {
                minlength: 2
            }
        },
        messages: {
            custom: {
                required: 'This is a custom error message'
            },
            basic_checkbox: {
                minlength: 'Please select at least {0} checkboxes'
            },
            styled_checkbox: {
                minlength: 'Please select at least {0} checkboxes'
            },
            switchery_group: {
                minlength: 'Please select at least {0} switches'
            },
            switch_group: {
                minlength: 'Please select at least {0} switches'
            },
            agree: 'Please accept our policy'
        }
    });
}
if($('.upload-images').length){
    $('.upload-images').each(function(){
        var images = $(this).parents('.div-image').find('.image_data').val();
        if(images === ''){
        }else{
            images = images.split(',');
            for(i=0;i < images.length;i++){
               var name = images[i];
               name = name.split('/');
               $(this).parents('.div-image').find('.file-drop-zone').append('<div class="file-preview-frame krajee-default  file-preview-initial file-sortable kv-preview-thumb">'+
                                                                                          '<div class="kv-file-content">'+
                                                                                                       '<img src="'+images[i]+'" class="file-preview-image kv-preview-data" title="'+name[4]+'" alt="'+name[4]+'" style="width:auto;height:auto;max-width:100%;max-height:100%;">'+
                                                                                           '</div>'+
                                                                                           '<div class="file-thumbnail-footer">'+
                                                                                           '<div class="file-footer-caption" title="'+name[4]+'">'+
                                                                                               '<div class="file-caption-info">'+name[4]+'</div>'+
                                                                                               '<div class="file-size-info"></div>'+
                                                                                           '</div>'+
                                                                                           '<div class="file-actions">'+
                                                                                               '<div class="file-footer-buttons">'+
                                                                                                     '<button type="button" class="kv-file-remove btn btn-link btn-icon btn-xs" title="Remove file" data-url="" data-key="1"><i class="icon-trash"></i></button>'+
                                                                                                     '<button type="button" class="kv-file-zoom btn btn-link btn-xs btn-icon" title="View Details"><i class="icon-zoomin3"></i></button>'+
                                                                                                 '</div>'+
                                                                                           '</div>'+
                                                                                       '</div>'+
                                                                                       '</div>');
            }
        }
    });

};

$('body').delegate('.kv-file-zoom','click',function(){
        $('.imagepreview').attr('src', $(this).parents('.file-preview-frame').find('.file-preview-image').attr('src'));
$('#titleimagepreview').html($(this).parents('.file-preview-frame').find('.file-caption-info').html());
        $('#imagemodal').modal('show');
});

$('body').delegate('.upload-images','change', function() {
    $this = $(this);
    var file_data = [];
    var form_data = new FormData();
    var $input = $(this).parents('.div-image').find('.image_data');
    var images = $(this).parents('.div-image').find('.image_data').val();
    if(images === ''){
        images=[];
    }else{
        images = images.split(',');
    }
    for (var i = 0; i < $(this)[0].files.length; i++) {
        form_data.append('file[]', $(this).prop('files')[i]);
    }
    $.ajax({
        url: '/api/upload',
        method: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(response.success == true){
                for(var i=0;i < response.image.length;i++ ){
                    $this.parents('.div-image').find('.file-drop-zone').append('<div class="file-preview-frame krajee-default  file-preview-initial file-sortable kv-preview-thumb">'+
                                                                                       '<div class="kv-file-content">'+
                                                                                                    '<img src="'+response.image[i]+'" class="file-preview-image kv-preview-data" title="'+response.name[i]+'" alt="'+response.name[i]+'" style="width:auto;height:auto;max-width:100%;max-height:100%;">'+
                                                                                        '</div>'+
                                                                                        '<div class="file-thumbnail-footer">'+
                                                                                        '<div class="file-footer-caption" title="'+response.name[i]+'">'+
                                                                                            '<div class="file-caption-info">'+response.name[i]+'</div>'+
                                                                                            '<div class="file-size-info"></div>'+
                                                                                        '</div>'+
                                                                                        '<div class="file-actions">'+
                                                                                            '<div class="file-footer-buttons file-button">'+
                                                                                                  '<button type="button" class="kv-file-remove btn btn-link btn-icon btn-xs" title="Remove file" data-url="" data-key="1"><i class="icon-trash"></i></button>'+

                                                                                              '</div>'+
                                                                                        '</div>'+
                                                                                    '</div>'+
                                                                                    '</div>');
                    images.push(response.image[i]);
                    var res = images.join(',');
                    $input.val(res);
                }
            }else{
                alert('File upload không hợp lệ');
            }
            }
        })
 });
if($('.upload-image').length){
     $('.upload-image').each(function(){
     var images = $(this).parents('.div-image').find('.image_data').val();
     console.log(images);
     if(images === ''){
     }else{
         images = images.split(',');
         for(i=0;i < images.length;i++){
            var name = images[i];
            name = name.split('/');
            $(this).parents('.div-image').find('.file-drop-zone').append('<div class="file-preview-frame krajee-default  file-preview-initial file-sortable kv-preview-thumb">'+
                                                                                       '<div class="kv-file-content">'+
                                                                                                    '<img src="'+images[i]+'" class="file-preview-image kv-preview-data" title="'+name[4]+'" alt="'+name[4]+'" style="width:auto;height:auto;max-width:100%;max-height:100%;">'+
                                                                                        '</div>'+
                                                                                        '<div class="file-thumbnail-footer">'+
                                                                                        '<div class="file-footer-caption" title="'+name[4]+'">'+
                                                                                            '<div class="file-caption-info">'+name[4]+'</div>'+
                                                                                            '<div class="file-size-info"></div>'+
                                                                                        '</div>'+
                                                                                        '<div class="file-actions">'+
                                                                                            '<div class="file-footer-buttons">'+
                                                                                                  '<button type="button" class="kv-file-remove btn btn-link btn-icon btn-xs" title="Remove file" data-url="" data-key="1"><i class="icon-trash"></i></button>'+
                                                                                                  '<button type="button" class="kv-file-zoom btn btn-link btn-xs btn-icon" title="View Details"><i class="icon-zoomin3"></i></button>'+
                                                                                              '</div>'+
                                                                                        '</div>'+
                                                                                    '</div>'+
                                                                                    '</div>');
         }
     }
     });

};
$('body').delegate('.upload-image','change', function() {
    var file_data = $(this).prop('files')[0];
    $this=$(this);
    var form_data = new FormData();
    var $input = $(this).parents('.div-image').find('.image_data');
    form_data.append('file', file_data);
    $.ajax({
        url: '/api/uploadImage',
        method: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(response.success == true){
                $input.val(response.image);
                $this.parents('.div-image').find('.file-drop-zone').html('<div class="file-preview-frame krajee-default  file-preview-initial file-sortable kv-preview-thumb">'+
                                                                                   '<div class="kv-file-content">'+
                                                                                                '<img src="'+response.image+'" class="file-preview-image kv-preview-data" title="'+response.name+'" alt="'+response.name+'" style="width:auto;height:auto;max-width:100%;max-height:100%;">'+
                                                                                    '</div>'+
                                                                                    '<div class="file-thumbnail-footer">'+
                                                                                    '<div class="file-footer-caption" title="'+response.name+'">'+
                                                                                        '<div class="file-caption-info">'+response.name+'</div>'+
                                                                                        '<div class="file-size-info"></div>'+
                                                                                    '</div>'+
                                                                                    '<div class="file-actions">'+
                                                                                        '<div class="file-footer-buttons">'+
                                                                                              '<button type="button" class="kv-file-remove btn btn-link btn-icon btn-xs" title="Remove file" data-url="" data-key="1"><i class="icon-trash"></i></button>'+
                                                                                              '<button type="button" class="kv-file-zoom btn btn-link btn-xs btn-icon" title="View Details"><i class="icon-zoomin3"></i></button>'+
                                                                                          '</div>'+
                                                                                    '</div>'+
                                                                                '</div>'+
                                                                                '</div>');
                $input.val(response.image);
            }else{
                alert('File upload không hợp lệ');
            }

        }
     });
});
$('body').delegate('.kv-file-remove,.fileinput-remove','click',function(){
   var image = $(this).parents('.file-preview-frame').find('.file-preview-image').attr("src");
    $.ajax({
       url: '/api/delete_image',
       method: 'POST',
       data: {link:image},
       success: function(response){
           if(response.success == true){
           }
       }
    });
   var $input = $(this).parents('.div-image').find('.image_data');
   var images = $(this).parents('.div-image').find('.image_data').val();
   images = images.split(',');
   var index = images.indexOf(image);
   if (index > -1) {
     images.splice(index, 1);
   }
   var res = images.join(',');
   $input.val(res);
   $(this).parents('.file-preview-frame').remove();
});
