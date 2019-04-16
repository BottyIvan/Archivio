$(document).ready(function () { 
    
    var navMenuItem = $('.navMenuItem'),
		viewItem = $('.viewItem'),
		editItem = $('.editItem'),
        redDel = $('.redDel'),
        saveEditItem = $('.saveEditItem'),
        btnEditItem = $('.btnEditItem'),
        slider = $('.slider');
    
    var itemID = slider.attr('item-id'),
        itemQuantity = slider.attr('item-quantity');
    
    var quantityChange = $('#quantityChange');
	   
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