function getAjax(url, data, method = "post", dataType = "JSON") {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        dataType: dataType
    });
}
$(document).ready(function () {
    $('select').niceSelect();
    var xhr;
    $('#autoComplete').autoComplete({
        minChars: 1,
        source: function (term, response) {
            term = term.toLowerCase();
            try {
                xhr.abort();
            } catch (e) {
            }
            xhr = getAjax('/api/get-products', {keyword: term}, 'post').done(function (data) {
                response(data);
            });
        }
    });
    $('#topAutoComplete').autoComplete({
        minChars: 1,
        source: function (term, response) {
            term = term.toLowerCase();
            try {
                xhr.abort();
            } catch (e) {
            }
            xhr = getAjax('/api/get-products', {keyword: term}, 'post').done(function (data) {
                response(data);
            });
        }
    });
    if ($('.all-attributes').length) {
        getAjax('/api/get-product-attribute', {ids: $('.attribute_id').val(), category_id: $('.category_id').val()}).done(function (resp) {
            $('.all-attributes').html(resp.html);
            $('.list-attribute').slimScroll({
                height: '350px'
            });
        });
    }
    if ($('.all-sale-product').length) {
        getAjax('/api/get-sale-product-attribute', {ids: $('.attribute_id').val(), category_id: $('.category_id').val()}).done(function (resp) {
            $('.all-sale-product').html(resp.html);
            $('.list-attribute').slimScroll({
                height: '350px'
            });
        });
    }

    $('body').delegate('[type="checkbox"]', 'change', function () {
        var ids = [];
        $('.attribute_select:checked').each(function () {
            ids.push($(this).val());
        })
        $('.attribute_id').val(ids.join(','));
        $(this).parents('form').submit();
    });
    if ($('.recent-post').length) {
        getAjax('/api/get-recent-post', {page: 0}).done(function (resp) {
            $('.recent-post').html(resp.html);
        });
        var page = 0;
        $(window).scroll(function () {
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 50) {
                ++page;
                getAjax('/api/get-recent-post', {page: page}).done(function (resp) {
                    $('.recent-post').append(resp.html);
                });
            }
        });
    }

    $('.login').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade'
        
    });
    $('.register').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade'
    });

    var menu_sidebar_btn = $('.hamburger.hamburger--spin');
    var menu_sidebar = $('.menu-sidebar');
    var menu_sidebar_overlay = $('.menu-sidebar-overlay');
    var menu_sidebar_close = $('.menu-sidebar-close');
    /*menu sidebar toggle*/
    menu_sidebar_btn.on('click', function () {
        $(this).toggleClass('active');
        menu_sidebar.toggleClass('menu-sidebar-open');
        menu_sidebar_overlay.toggleClass('menu-sidebar-overlay-active');

    });
    /*menu sidebar close*/
    menu_sidebar_close.on('click', function () {
        menu_sidebar_btn.removeClass('active');
        menu_sidebar.removeClass('menu-sidebar-open');
        menu_sidebar_overlay.removeClass('menu-sidebar-overlay-active');
    });

    menu_sidebar_overlay.on('click', function () {
        menu_sidebar_btn.removeClass('active');
        menu_sidebar.removeClass('menu-sidebar-open');
        menu_sidebar_overlay.removeClass('menu-sidebar-overlay-active');
    });
    // $('.has-menu').on('click', function () {
    //     $('.menu-child').toggleClass('menu-child-open');
    // })
    $(".has-menu").on('click', function () {
        $(this).toggleClass('active');
        $(this).find('.menu-child').slideToggle();
    });
});
$('#newsletter_form').submit(function (e) {
    e.preventDefault();
    getAjax('/api/add-subscriber', $(this).serialize()).done(function (resp) {
        if (resp.success === true) {
            swal({
                title: "Chúc mừng bạn đã đăng ký nhận tin thành công",
                icon: "success"
            });
        }
        $('#newsletter_form')[0].reset();
    })
});
$('#password1').change(function () {
    if ($(this).val().length < 6) {
        var span = "Nhập mật khẩu tối thiểu 6 kí tự";
        $(this).parent().find('.help-block').html(span);
    } else {
        $('.help-block').html('');
    }
});
$('#password2').change(function (e) {
    if ($(this).val() != $('#password1').val()) {
        var span = "Nhập lại mật khẩu không trùng khớp";
        $(this).parent().find('.help-block').html(span);
    } else {
        $('.help-block').html('');
    }
});

$('#username1').change(function () {
    var username = $(this).val();
    var $this = $(this);
    var type = $('input[name="type"]:checked').val();
    if (type == 1) {
        $.ajax({
            url: '/api/check-user-marketing',
            method: 'POST',
            data: {username: username, _token: $('#token').val()},
            dataType: 'JSON',
            success: function (resp) {
                if (resp.success == false) {
                    var span = "Username đã tồn tại";
                    $this.parent().find('.help-block').html(span);
                } else {
                    $('.help-block').html('');
                }
            }
        });
    } else {
        $.ajax({
            url: '/api/check-user-construction',
            method: 'POST',
            data: {username: username, "_token": $('#token').val()},
            dataType: 'JSON',
            success: function (resp) {
                if (resp.success == false) {
                    var span = "Username đã tồn tại";
                    $this.parent().append(span);
                } else {
                    $('.help-block').remove();
                }
            }
        });
    }
})
$('#frmRegister').submit(function (e) {
    e.preventDefault();
    var type = $('input[name="type"]:checked').val();
    $('.load').css('display', 'block');
    $('.register-btn').attr("disabled", "disabled");
    if (type == 1) {
        $.ajax({
            url: '/api/register-marketing',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.load').css('display', 'none');
                $('.register-btn').removeAttr("disabled", "");
                $('.login').magnificPopup('close');
                swal({
                    title: "Đăng ký tài khoản thành công. Bạn vui lòng vào gmail để xác thực tài khoản",
                    type: "success"
                });
                $('#frmRegister')[0].reset();
            }
        });
    } else if(type == 2) {
        $.ajax({
            url: '/api/register-construction',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.load').css('display', 'none');
                $('.register-btn').removeAttr("disabled", "");
                $('.login').magnificPopup('close');
                swal({
                    title: "Đăng ký tài khoản thành công. Bạn vui lòng vào gmail để xác thực tài khoản",
                    icon: "success"
                });
                $('#frmRegister')[0].reset();
            }
        });
    }else if(type == 3){
        $.ajax({
            url: '/api/register-member',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.load').css('display', 'none');
                $('.register-btn').removeAttr("disabled", "");
                $('.login').magnificPopup('close');
                swal({
                    title: "Đăng ký tài khoản thành công. Bạn vui lòng vào gmail để xác thực tài khoản",
                    icon: "success"
                });
                $('#frmRegister')[0].reset();
            }
        });
    }
});
$('#frmLogin').submit(function (e) {
    e.preventDefault();
    var type = $('input[name="type_login"]:checked').val();
    if ($('#username').val() == '') {
        var span = "Username không được để trống";
        $('#username').parent().find('.help-block').html(span);
        return;
    }
    if ($('#password').val().length < 6) {
        var span = "Nhập mật khẩu tối thiểu 6 kí tự";
        $('#password').parent().find('.help-block').html(span);
        return;
    }
    if (type == 1) {
        $.ajax({
            url: '/api/login-marketing',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.login').magnificPopup('close');
                if (resp.success == true) {
                    swal({
                        title: "Đăng nhập thành công",
                        type: 'success'
                    }, function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Đăng nhập không thành công",
                        type: 'error'
                    });
                }
            }
        });
    } else if(type == 2) {
        $.ajax({
            url: '/api/login-construction',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.login').magnificPopup('close');
                if (resp.success == true) {
                    swal({
                        title: "Đăng nhập thành công",
                        type: "success"
                    }, function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Đăng nhập không thành công",
                        type: "error"
                    });

                }
            }
        });
    }else if(type ==3){
        $.ajax({
            url: '/api/login-member',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.login').magnificPopup('close');
                if (resp.success == true) {
                    swal({
                        title: "Đăng nhập thành công",
                        type: "success"
                    }, function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Đăng nhập không thành công",
                        type: "error"
                    });

                }
            }
        });
    }
});

$('.news-owl-carousel.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    dots: false,
    nav: true,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
});
$('.quantity').change(function () {
    var product_id = $(this).data('product_id');
    var quantity = $(this).val();
    $.ajax({
        url: '/api/update-cart',
        method: 'POST',
        data: {product_id: product_id, quantity: quantity},
        success: function (resp) {
            if (resp.success == true) {
                $('.itm-cont').html(resp.count);
                $('#total').html(resp.total + ' đ');
                swal('Lưu thành công');
                window.location.reload(true);
            } else {
                swal('Lưu thất bại');
            }
        }
    });
})
$('.delete').click(function () {
    var product_id = $(this).data('product_id');
    $.ajax({
        url: '/api/delete-cart',
        method: 'POST',
        data: {product_id: product_id},
        success: function (resp) {
            if (resp.success == true) {
                $('.itm-cont').html(resp.count);
                $('#total').html(resp.total + ' đ');
            }
        }
    });
    $('#product_' + product_id).fadeOut();
});
$('.video-owl-carousel.owl-carousel').each(function () {
    var ifMultiple = false;
    $thisGallery = $(this);
    if ($thisGallery.children('.item').length > 3) {
        ifMultiple = true;
    }
    $thisGallery.owlCarousel({
        loop: ifMultiple,
        margin: 10,
        dots: false,
        nav: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
});
function validate_select() {
    var contact = document.form.contact.value;
    var mobile = document.form.mobile.value;
    var email = document.form.email.value;
    var address = document.form.address.value;
    var payment_method = document.form.payment_method.value;
    var transport_method = document.form.transport_method.value;
    $('.input-name .help-block').remove();
    if (contact == '')
    {
        var span = "<span class='help-block'>Xin hãy điền đầy đủ thông tin</span>";
        $(".input-name").append(span);
        return false;
    }
    if (mobile == '')
    {
        var span = "<span class='help-block'>Xin hãy điền đầy đủ thông tin</span>";
        $(".input-mobile").append(span);
        return false;
    }
    if (email == '')
    {
        var span = "<span class='help-block'>Xin hãy điền đầy đủ thông tin</span>";
        $(".input-email").append(span);
        return false;
    }
    if (payment_method == 0)
    {
        var span = "<span class='help-block'>Xin hãy chọn phương thức thanh toán</span>";
        $(".select_payment").append(span);
        return false;
    }
    if (transport_method == 0)
    {
        var span = "<span class='help-block'>Xin hãy chọn phương thức vận chuyển</span>";
        $(".select_transport").append(span);
        return false;
    }
    if (address == '')
    {
        var span = "<span class='help-block'>Xin hãy điền đầy đủ thông tin</span>";
        $(".input-address").append(span);
        return false;
    }
    return true;
}
$(window).scroll(function () {
    if ($(this).scrollTop() > 100){
        $("#toTop").fadeIn();
        $("#top-search").addClass("search-show");
    }
    else{
        $("#toTop").fadeOut();
        $("#top-search").removeClass("search-show");
    }
});
$(window).scroll(function () {
    var scrolltobottom = document.documentElement.scrollHeight - $(this).outerHeight() - $(this).scrollTop();
    if ($(this).scrollTop() > 50 && scrolltobottom > 400 ){
        $("#filters_col").addClass("filters-show");
    }
    else{
        $("#filters_col").removeClass("filters-show");
    }
});
$("#toTop").click(function () {
    $("body,html").animate({scrollTop: 0}, "slow");
});

$('.item-list').slimScroll({
    height: '350px'
});
$('#number-select').change(function(){
    $('.count_product').val($(this).val());
    $(this).parents('form').submit();
});
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
                                                                                               '<div class="file-footer-buttons file-button">'+
                                                                                                     '<button type="button" class="kv-file-remove btn btn-link btn-icon btn-xs" title="Remove file" data-url="" data-key="1"><i class="icon-trash"></i></button>'+
                                                                                                    
                                                                                                 '</div>'+
                                                                                           '</div>'+
                                                                                       '</div>'+
                                                                                       '</div>');
            }
        }
    });

};
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