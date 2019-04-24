$(document).ready(function () { 
    
    var navMenuItem = $('.navMenuItem'),
		viewItem = $('.viewItem'),
		editItem = $('.editItem'),
        redDel = $('.redDel'),
        saveEditItem = $('.saveEditItem'),
        btnEditItem = $('.btnEditItem'),
        slider = $('.slider'),
		basketItem = $('.basketItem');
    
	var formData = $('#editItemFrom'),
		idElement = $('#editItemFrom').attr('id-element');
	
    var itemID = slider.attr('item-id'),
        itemQuantity = slider.attr('item-quantity');
    
    var quantityChange = $('#quantityChange');
	
	var basketItemID = basketItem.attr('item-id');
	   
	saveEditItem.on('click',function(){
		// at the click serializeArray
		var dataSerialize = formData.serializeArray();
		$.post("../CORE/sql.php?operation=edit&id="+idElement,{data : dataSerialize})
		 .done(function(e){
			console.log(e);
			console.log("Element "+idElement+" update");
		})
		.fail(function(data){
			console.log("Error : "+data);
		});
	});
	
    slider.slider({
        value: itemQuantity,
        min: 0,
        max: 100,
        slide: function(event, ui){
            quantityChange.html(ui.value);
            console.log("value: "+ui.value);
        },
        stop: function(event, ui ){
            $.post("CORE/sql.php?operation=edit&id="+itemID,{quantity : ui.value});
        }
    });
	
	basketItem.on('click',function(){
		if(basketItem.hasClass('inBasket')){
			$.post("../CORE/sql.php?operation=edit&id="+basketItemID,{basket : 'n'})
			 .done(function(){
				basketItem.removeClass('inBasket');	
			});
		} else {
			$.post("../CORE/sql.php?operation=edit&id="+basketItemID,{basket : 's'})
			 .done(function(e){
				basketItem.addClass('inBasket');	
			});
		}
	});
	
	navMenuItem.on('click',function(){
		navMenuItem.removeClass('activeMenu');
		menuItem = $(this).attr('menu');
		if(menuItem == 'view'){
			editItem.hide();
			viewItem.show();
			redDel.hide();
			saveEditItem.hide();
			$(this).addClass('activeMenu');
		}
		if(menuItem == 'edit') {
			viewItem.hide();
			editItem.show();
			redDel.show();
			saveEditItem.show();
			$(this).addClass('activeMenu');
		}
	});
    
    $('.mainView').on('scroll',function(){
        if($('.mainView').scrollTop() > 50) $('.toolBar').addClass('fixedToolBar');
        else $('.toolBar').removeClass('fixedToolBar');
    });
    
});