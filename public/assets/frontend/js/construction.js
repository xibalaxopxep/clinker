/* global toastr */

var current_star_statusses = [];

star_elements = $('.fa-star').parent();

star_elements.find(".fa-star").each(function (i, elem) {
    current_star_statusses.push($(elem).hasClass('yellow'));
});

star_elements.find(".fa-star").mouseenter(changeRatingStars);
star_elements.find(".fa-star").mouseleave(resetRatingStars);

/**
 * Changes the rating star colors when hovering over it.
 */
function changeRatingStars() {
    // Current star hovered
    var star = $(this);

    // Removes all colors first from all stars
    $('.fa-star').removeClass('gray').removeClass('yellow');

    // Makes the current hovered star yellow
    star.addClass('yellow');

    // Makes the previous stars yellow and the next stars gray
    star.parent().prevAll().children('.fa-star').addClass('yellow');
    star.parent().nextAll().children('.fa-star').addClass('gray');
}

/**
 * Resets the rating star colors when not hovered anymore.
 */
function resetRatingStars() {
    star_elements.each(function (i, elem) {
        $(elem).removeClass('yellow').removeClass('gray').addClass(current_star_statusses[i] ? 'yellow' : 'gray');
    });
}
//Scroll  (Added at 30/05/2019)      
$("a.scroll-from").click(function () {
    var id = $(this).attr('href');
    $("html, body").animate({scrollTop: $(id).offset().top - 90}, 1200);
    return true;
});
$('#frmContact').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: '/api/send-contact',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'JSON',
        success: function (resp) {
            if (resp.success) {
                swal({
                    title: "Gửi liên hệ thành công",
                    type: "success"
                });
                $('#mdlContact').modal('hide');
            }
        }
    });
})

var curInputId = undefined;
function BrowseServer(div) {
    curInputId = div;
    window.KCFinder = {
        callBack: function (url) {
            fileUrl = url;
            //window.KCFinder = null;
            div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function () {
                var fileName = fileUrl.split('/');
                fileName = fileName[fileName.length - 1];
                jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-input-new').removeClass('file-input-new');
                jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-caption-name').text(fileName).attr('title', fileName);
                //Hien tai co anh 
                if (jQuery('#' + curInputId).length && jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-preview-image').length) {
                    if (!$('#' + curInputId + '[multiple]').length)
                        jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-preview-frame').remove();
                    var count = jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-preview-image').length;
                    var html = '<div class="file-preview-frame" id="preview-' + $.now() + '-' + (count) + '" data-fileindex="' + (count) + '" data-template="image"><div class="kv-file-content"> <img src="' + fileUrl + '" class="kv-preview-data file-preview-image" title="' + fileName + '" alt="' + fileName + '" style="width:auto;height:160px;"> </div><div class="file-thumbnail-footer"> <div class="file-footer-caption" title="' + fileName + '">' + fileName + ' <br></div> <div class="file-actions"> <div class="file-footer-buttons"> <button type="button" class="kv-file-zoom btn btn-link btn-xs btn-icon" title="View Details"><i class="icon-zoomin3"></i></button>     </div>  <div class="file-upload-indicator" title="Not uploaded yet"><i class="icon-file-plus text-slate"></i></div> <div class="clearfix"></div> </div> </div> </div>';
                    /*
                     if (jQuery('input[name="'+curInputId+'"]').parents('.form-group').find('.file-initial-thumbs').length){
                     $('.file-preview-frame').remove();
                     }*/
                    if (jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-live-thumbs').length)
                        jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-live-thumbs').append(html);
                    else
                        jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-initial-thumbs').append(html);
                    jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-caption-name:last').prepend('<i class="glyphicon glyphicon-file kv-caption-icon"></i>');
                    var values = [];
                    if ($('#' + curInputId + '[multiple]').length)
                        values.push(jQuery('input[name="' + curInputId + '"]').val());
                    values.push(fileUrl);
                    jQuery('input[name="' + curInputId + '"]').val(values.join(','));

                } else {
                    if (!$('#' + curInputId + '[multiple]').length)
                        jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-preview-frame').remove();
                    var html = '<div class="file-preview"> <div class="close fileinput-remove">×</div> <div class="file-drop-disabled"> <div class="file-preview-thumbnails"> <div class="file-live-thumbs"> <div class="file-preview-frame" id="preview-' + $.now() + '-0" data-fileindex="0" data-template="image"><div class="kv-file-content"> <img src="' + fileUrl + '" class="kv-preview-data file-preview-image" title="' + fileName + '" alt="' + fileName + '" style="width:auto;height:160px;"> </div><div class="file-thumbnail-footer"> <div class="file-footer-caption" title="' + fileName + '">' + fileName + ' <br></div> <div class="file-actions"> <div class="file-footer-buttons"> <button type="button" class="kv-file-zoom btn btn-link btn-xs btn-icon" title="View Details"><i class="icon-zoomin3"></i></button>     </div>  <div class="file-upload-indicator" title="Not uploaded yet"><i class="icon-file-plus text-slate"></i></div> <div class="clearfix"></div> </div> </div> </div>  </div> </div></div> <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div> <div class="kv-fileinput-error file-error-message" style="display: none;"></div> </div> </div>';
                    jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-input').prepend(html);
                    jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-caption-name').prepend('<i class="glyphicon glyphicon-file kv-caption-icon"></i>');
                    jQuery('input[name="' + curInputId + '"]').val(fileUrl);
                    //jQuery('input[name="'+curInputId+'"]').parents('.form-group').find('.file-preview:last')
                }
                jQuery('input[name="' + curInputId + '"]').parents('.form-group').find('.file-preview-thumbnails').each(function () {
                    if (!$(this).html().trim().length)
                        $(this).parents('.file-preview').remove();
                });
            }

        }
    };
    window.open('/assets/backend/kcfinder-3.20/browse.php?type=images',
            'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
            'directories=0, resizable=1, scrollbars=0, width=800, height=600'
            );
}
function sortImage(elm) {
    if (elm) {
        if ($(elm).parents('.form-group').find('.file-preview-thumbnails .file-live-thumbs').length) {
            $(elm).parents('.form-group').find('.file-preview-thumbnails .file-live-thumbs').sortable({
                revert: true,
                stop: function (event, ui) {
                    $(ui.item[0]).parents('.form-group').find("input[type='hidden']").val($(ui.item[0]).parents('.form-group').find('img:visible').map(function () {
                        return $(this).attr('src');
                    }).get().join(','))
                    $(ui.item[0]).parents('.form-group').find('.kv-image-counter').each(function () {
                        $(this).text(parseInt($(this).parents('[data-template]').index(), 10) + 1);
                    });
                    var str_img = $(ui.item[0]).parents('.form-group').find('img.kv-preview-data').map(function () {
                        return this.src;
                    }).get().join(',');
                }
            });
        }
    } else {
    }
}
$(document).ready(function () {
    $('.select-munti').select2();
});

$(function(){
    if ($(".file-input-extensions").length) {
        $('body').delegate('.file-actions .btn-link', 'click', function () {
            var indx = $(this).parents('[data-template]').index();
            var name = $(this).parents('.form-group').find('input[type="hidden"]').attr('name');
            var elm_parent = $(this).parents('.file-live-thumbs')[0];
            $(this).parents('[data-template]').remove();

            if (!$(elm_parent).find('[data-template]').length) {
                $(elm_parent).parents('.file-input').find('.file-caption-name').text('Không có ảnh');
                $(elm_parent).parents('.file-input').toggleClass('file-input-new', true);
            }
            $(elm_parent).find('.kv-image-counter').each(function () {
                $(this).text(parseInt($(this).parents('[data-template]').index(), 10) + 1);
            });
            var str_img = $(elm_parent).find('img.kv-preview-data').map(function () {
                return this.src;
            }).get().join(',');
            $('[name="' + name + '"]').val(str_img);
        });
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
                '  <div class="modal-content">\n' +
                '    <div class="modal-header">\n' +
                '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
                '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
                '    </div>\n' +
                '    <div class="modal-body">\n' +
                '      <div class="floating-buttons btn-group"></div>\n' +
                '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
                '    </div>\n' +
                '  </div>\n' +
                '</div>\n';
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
            fullscreen: 'btn btn-default btn-icon btn-xs',
            borderless: 'btn btn-default btn-icon btn-xs',
            close: 'btn btn-default btn-icon btn-xs'
        };
        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross3"></i>'
        };

        // File actions
        var fileActionSettings = {
            zoomClass: 'btn btn-link btn-xs btn-icon',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'btn btn-link btn-xs btn-icon',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: 'btn btn-link btn-icon btn-xs',
            removeIcon: '<i class="ion-trash-a"></i>',
            indicatorNew: '<i class="ion-plus text-slate"></i>',
            indicatorSuccess: '<i class="ion-checkmark file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        };
        $(".file-input-extensions").each(function () {
            var initPreview = $('input[name="' + this.id + '"]').val().split(',');
            for (i = 0; i < initPreview.length; i++) {
                initPreview[i] = initPreview[i];
            }
            var initPreviewConfig = [];
            for (i = 0; i < initPreview.length; i++) {
                var fileNames = initPreview[i].split('/');
                var fileName = fileNames[fileNames.length - 1];
                var obj = {caption: fileName, key: i + 1, showDrag: false};
                initPreviewConfig.push(obj);
            }
            var options = {
                browseLabel: 'Chọn',
                removeLabel: 'Xóa',
                browseClass: 'btn btn-primary',
                uploadClass: 'btn btn-default',

                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                    modal: modalTemplate
                },
                maxFilesNum: 10,
                allowedFileExtensions: ["jpg", "gif", "png", "txt"],
                initialCaption: 'Không có ảnh',
                previewZoomButtonClasses: previewZoomButtonClasses,
                previewZoomButtonIcons: previewZoomButtonIcons,
                fileActionSettings: fileActionSettings,
                initialPreviewAsData: true,
                overwriteInitial: false,
            };
            if (initPreviewConfig.length) {
                options.initialPreview = initPreview;
                options.initialPreviewConfig = initPreviewConfig;
            }
            $(this).fileinput(options);
        }).on('filecleared', function (event) {
            $('input[name="' + event.target.id + '"]').parents('.form-group').find('.file-preview').remove();
            $('input[name="' + event.target.id + '"]').val('');
        });
    }
})
//Login with facebook
$('.review-button').click(function (e) {
    e.preventDefault();
    $('.login-fb').attr('data-href', this.dataset.href);
})
window.hocwp = window.hocwp || {};
function facebook_login_status_callback(response) {
    if (response.status === 'connected') {
        facebook_login_connected_callback();
    } else if (response.status === 'not_authorized') {

    } else {

    }
}
function facebook_login() {
    FB.login(function (response) {
        facebook_login_status_callback(response);
    }, {scope: 'email,public_profile'});
}
window.fbAsyncInit = function () {
    FB.init({
        appId: '579674162603685',
        cookie: true,
        xfbml: true,
        version: 'v2.10'
    });
};
function facebook_login_connected_callback() {
    FB.api('/me', {fields: 'id,name,first_name,last_name,picture,verified,email'}, function (response) {
        (function ($) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/api/login-with-fb-sdk',
                data: response,
                success: function (response) {
                    /*ar href = window.location.href;
                     if($.trim(response.redirect_to)) {
                     href = response.redirect_to;
                     }*/
                    window.location.href = $('.login-fb').data('href');
                }
            });
        })(jQuery);
    });
}
$('#frmReviews').submit(function (e) {
    var rating = $('#frmReviews .fa-star.yellow').length;
    var content = $("#content_review").val();
    var construction_id = $('#construction_id').val();
    var review_person_id = $('#review_person_id').val();
    e.preventDefault();
    $.ajax({
        url: '/api/add-review',
        method: 'post',
        data: {star: rating, content: content, construction_id: construction_id, review_person_id: review_person_id},
        dataType: 'JSON',
        success: function (resp) {
            if (resp.success == true) {
                swal({
                    title: 'Thao tác thành công',
                    type: 'success'
                });
            }
            $('#frmReviews')[0].reset();
        }
    });

});