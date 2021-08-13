function getAjax(url, data, method = "post", dataType = "JSON") {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        dataType: dataType
    });
}
$(document).ready(function () {
    /*'use strict'
    var page = 1;
    function getProduct($url, $method, $data) {
        return $.ajax({
            url: $url,
            method: $method,
            data: $data
        });
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            //alert('Hello');
            ++page;
            getProduct('/ajax/get-product-mobile.html', 'post', {'page': page}).done(function (resp) {
                resp = JSON.parse(resp);
                $('#list-product').append(resp.html);
            })
        }
    });*/
    $(document).ajaxStart(function () {
        $("#loading").show();
    }).ajaxStop(function () {
        $("#loading").hide();
    });
    getAjax('/api/get-recent-post-mobile', {page: 0}).done(function (resp) {
        $('.recent-post-mobile').html(resp.html);
    })
    var page1 = 0;
    
    $(window).on('scroll', function() { 
            if ($(window).scrollTop() >= $( 
              '.recent-post-mobile').offset().top + $('.recent-post-mobile'). 
                outerHeight() - window.innerHeight) { 
                
                ++page1;
            getAjax('/api/get-recent-post-mobile', {page: page1}).done(function (resp) {
                $('.recent-post-mobile').append(resp.html);
            })
            } 
    }); 
});
