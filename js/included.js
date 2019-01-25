$(document).ready(function () { 
    
    var editItem = $('.editItem'),
        redDel = $('.redDel'),
        saveEditItem = $('.saveEditItem'),
        btnEditItem = $('.btnEditItem');
    
    btnEditItem.click(function(){
        editItem.show();
        redDel.show();
        saveEditItem.show();
        btnEditItem.hide();
    });
    
    $('.mainView').on('scroll',function(){
        if($('.mainView').scrollTop() > 50) $('.toolBar').addClass('fixedToolBar');
        else $('.toolBar').removeClass('fixedToolBar');
    });
    
});