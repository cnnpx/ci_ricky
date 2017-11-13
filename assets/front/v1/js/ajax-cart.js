$(document).on('click','.Addcart', function(e){
	e.preventDefault();
	var id = $(this).data('variantid');
	var qty = 1;
	Addcart(id,qty);
	$('html, body').animate({
		scrollTop: 0
	}, 500);
})
$(document).on('click','#quick-view-modal button.btn-addcart', function(e){
	e.preventDefault();
	var id = $('#quick-view-modal select#p-select').val()
	var qty = $('#quick-view-modal .form-input input[type=number]').val();
	Addcart(id,qty);
	$('html, body').animate({
		scrollTop: 0
	}, 500);
	$('#quick-view-modal .modal-header .close').click()
})
$(document).on('click','.ajax_addCart', function(e){
	e.preventDefault();
	var id = '';
	if($(this).closest('form').find('input[name="id"]').size() > 0){
		id = $(this).closest('form').find('input[name="id"]').val();
	}else{
		id = $(this).closest('form').find('select').val()
	}
	var qty = $('.quickview-product .js-qty input[type="text"]').val();
	Addcart(id,qty);
	$('.quickview-product').removeClass('active');
})
$(document).on('click','.ajaxcart__remove', function(e){
	e.preventDefault();
	$(this).parents('.list_product_cart').remove();
	var id = $(this).data('id');
	updateCart(id,0);
})
$(document).on('click','.ajaxcart__close, .overlay', function(){
	$('.ajax-cart-popup').removeClass('active');
})
$(document).on('click','.open-cart-popup, a.cart_temp', function(e){
	e.preventDefault();
	$('.ajax-cart-popup').addClass('active');
})
$(document).on('change','.ajaxcart__qty-num', function(){
	var $this = $(this);
	var qty = $this.val();
	var id = $this.data('id');
	updateCart(id,qty);
})
$(document).on('keypress change','textarea#CartSpecialInstructions', function(){
	$.ajax({
		type: "POST",
		url: '/cart/update.js',
		data: {"note": $(this).val()},
		dataType: 'json',
		success: function() {

		} 
	});
})
function Addcart(id,qty){
	var params = {
		type: 'POST',
		url: '/cart/add.js',
		data: 'quantity=' + qty + '&id=' + id,
		dataType: 'json',
		success: function(line_item) { 
			getCartView();
		},
		error: function(XMLHttpRequest, textStatus) {
			Haravan.onError(XMLHttpRequest, textStatus);
		}
	};
	jQuery.ajax(params);
} 
function getCartView(){
	var popup = $('.ajax-cart-popup');
	popup.find('#AjaxifyCart').remove();
	$.ajax({
		url : "/cart?view=mini",
		success: function(data){
			var parsed = $.parseHTML(data);
			popup.find('.content').append(data);
			$('.CartCount').html($(parsed).filter('.wrap__list-cart').val());
			setTimeout(function(){popup.addClass('active')},600)
		}
	})
}
function updateCart(id,qty){
	var params = {
		type: 'POST',
		url: '/cart/change.js',
		data: 'quantity='+ qty +'&id=' + id,
		dataType: 'json',
		success: function(cart) {
			//console.log(cart);
			updateMoney(id);
			$('.CartCount').html(cart.item_count);
			if(cart.item_count == 0 ){
				getCartView();
			}
		}
	};
	jQuery.ajax(params);
}
function updateMoney(id){
	$.ajax({
		url : "/cart?view=mini",
		success: function(data){
			var parsed = $.parseHTML(data);
			//console.log($(parsed).filter('.wrap__total_money').val());
			$('#AjaxifyCart .cart__subtotal span.money').html($(parsed).filter('.wrap__total_money').val()); 
			$('.list_product_cart[data-id="'+id+'"] .money_line span').html($(parsed).filter('#AjaxifyCart').find('.line_money_temp[data-id="'+id+'"]').val()); 
			console.log($(parsed).filter('#AjaxifyCart').find('.line_money_temp[data-id="'+id+'"]').val() + ' -- ' + id);
		}
	})
}