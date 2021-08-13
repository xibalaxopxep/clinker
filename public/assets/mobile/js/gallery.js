$(document).keydown(function (event) {
    if (event.which === 27) {
        initLoading();
        window.location.href = readCookie('latest_category_url');
    } else if (event.which === 39) {
        initLoading();
        window.location.href = $('.url-next')[0].href;
    } else if (event.which === 37) {
        initLoading();
        window.location.href = $('.url-prev')[0].href;
    }
});
function showTags(images, key) {/*
 var images = [
 {title:'This is a tree',position_x:0.19,position_y:0.4},
 {title:'Pretty sure this is also a tree',position_x:0.5,position_y:0.3},
 {title:'Can you guess this one?',position_x:0.775,position_y:0.5},
 ];*/
    var image = $('.gallery-basic[data-key="' + key + '"]')[0];// document.getElementById('gallery-basic');// document.getElementById('gallery-basic');
    var options = {};
    var data = [];
    for (i = 0; i < images.length; i++) {
        data.push(
            Taggd.Tag.createFromObject({
                position: {
                    x: images[i].position_x,
                    y: images[i].position_y
                },
                text: images[i].title,
            })
        );
    }
    var taggd = new Taggd(image, options, data);
    $('.taggd .taggd__wrapper').each(function (index, e) {
        $(this).attr('title', images[index].title);
        $(this).attr('data-key', images[index].id);
        $(this).appendTo('.gallery-basic[data-key="' + images[index].id + '"]');
    });
}
function getTags(key) {
    $.ajax({
        url: '/api/get-tags',
        method: 'POST',
        data: {gallery_id: key},
        dataType: 'JSON',
        success: function (resp) {
            if (resp.success) {
                showTags(resp.records, key);
                $('#tag_count').text(resp.records.length);
            }
        }
    });
}
function getProducts(keyword) {
    $.ajax({
        url: '/api/get-products-by-tag',
        method: 'POST',
        data: {tag_title: keyword},
        dataType: 'JSON',
        success: function (resp) {
            if (resp.success) {
                var result = '<div class="list-products-getbytag">';
                resp.records.forEach(function (entry) {
                    result += '<a href="' + entry.url + '" class="item"><img src="' + entry.image + '"/><p>' + entry.title + '</p></a>';
                });
                result += '</ul></div>';
                $('.thumb-img').css('max-height', 'calc(100vh)');
               
                $('.thumb-img').append(result);
                $('.list-products-getbytag').attr('style' ,'opacity:1');
            }
        }
    });
}
jQuery(function () {
    $('body').delegate('.taggd__wrapper', 'click', function () {
        $('.thumb-img .list-products-getbytag').remove();
        getProducts(this.title);
        // $('.taggd').attr('style','height:calc(100% - 80px)');
    });
    $('.gallery-basic').each(function () {

        getTags(this.dataset.key);
    });

    $('.show').on('click', function () {
        $(this).toggleClass('active');
        $('.image-info').toggleClass('image-info-open');
        $('.image-info-overlay').toggleClass('image-info-overlay-active');
    });
    $('.image-info-close').on('click', function () {
        $('.show').removeClass('active');
        $('.image-info').removeClass('image-info-open');
        $('.image-info-overlay').removeClass('image-info-overlay-active');
    });
    $('.image-info-overlay').on('click', function () {
        $('.show').removeClass('active');
        $('.image-info').removeClass('image-info-open');
        $('.image-info-overlay').removeClass('image-info-overlay-active');
    });
    $('#image').click(function(){
        $('.list-products-getbytag').css('opacity', 0);
        $('.taggd').css('height', '100%');
    })
});


