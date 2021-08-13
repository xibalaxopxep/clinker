$('a[data-action ="add-to-cart"]').click(function(){
     var product_id=$(this).data('product_id');
     var quantity=$('#quantity').val();
     $.ajax({
            url:'/api/add-to-cart',
            method:'POST',
            data:{product_id : product_id,quantity:quantity},
            success:function(resp){
               if(resp.success == true){
                    $('.cart_count').html(resp.count);
                    $('#notification-success').addClass('notification-fixed-active');
                    setTimeout(function(){  $('#notification-success').removeClass('notification-fixed-active'); }, 1000); 
               }else{
                    $('#notification-error').addClass('notification-fixed-active');  
                    $('#notification-err').html(resp.message);
               }
            }
        });
     
 })
jQuery(function(){
    $('body').delegate('a[data-action="remove-cart-item"]','click', function(e){
        e.preventDefault();
        $.ajax({
            url:'/api/delete-cart',
            method:'POST',
            data:this.dataset,
            success:function(resp){
                if (resp.success){
                     $('.cart_count').html(resp.count);
                     $('#amount_total').html(resp.total+' Đ');
                }
            }
        });
        $('#product'+$(this).data('product_id')).fadeOut();
    });
    $('body').delegate('a[data-action="add-to-cart"]', 'click', function(){
        addToCart(this.dataset.product_id,$('#quantity').val()||1);    
    });
    $('body').delegate('.cart', 'click', function(){
        window.location=$(this).data('link');
    });
})
$(document).ready(function()
{   
    $('body').delegate('.btn-number','click',function(e){
    e.preventDefault();
    var type = $(this).data('type');
    var input = $(this).parent().find('input');
    var currentVal = parseInt($(this).parent().find('input').val());
    if (!isNaN(currentVal)) {
        if(type == 'max') {
                input.val(currentVal + 1).change();
        } 
        else if(type == 'min') {
               if(currentVal == 1){
                input.val(currentVal).change();
               }else{
                input.val(currentVal - 1).change();
               }
            }
        }
});
    $(".qty").change(function(e){
        e.preventDefault();
        product_id=$(this).data('product_id');
        $this=$(this);
        quantity=$(this).val();
        $.ajax({
            url:'/api/update-cart',
            method:'POST',
            data:{'product_id':product_id,'quantity':quantity},
            success:function(resp){
                if (resp.success){
                        $('#amount_total').html(resp.total+' Đ'); 
                        $('.cart_count').html(resp.count);
                        $this.parents('.store-cart-1').find('.price123').html(resp.new_price+' đ');
            }
    }
    });
});
});
