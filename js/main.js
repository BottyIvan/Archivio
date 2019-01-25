$(document).ready(function () { 

    var body = $('body'),
        formSearch = $('.formSearch'),
        linkItem = $('.linkItem'),
        openView = $('.openView'),
        openViewOption = $('.openViewOption'),
        fullText = $('.fullText'),
        view = $('.view'),
        closeViewArea = $('.closeViewArea'),
        mainView = $('.mainView'),
        screenY = $( window ).height(),
        screenX = $( window ).width();
    
    console.log("window height: "+screenY);
	console.log("window width: "+screenX);
        
    addScrollText();
    
	$( window ).resize(function() {
	  	console.log("window resized");
	  	screenY = $( window ).height();
        screenX = $( window ).width();
        
        addScrollText();
    });
    
    $(window).on('scroll',function(){
        if($(window).scrollTop() > 50) formSearch.addClass('fixedBar');
        else formSearch.removeClass('fixedBar');
        
       /*
       not ready
        var idOld = 0;
        var idItem = $('.loadingMore').attr('fetch-data');
        if((($(window).scrollTop() == $(document).height()) - $(window).height()) && (idOld != idItem)){
            $.ajax({
                type: 'POST',
                url: '../archivio/CORE/fetch_data.php',
                data: 'id='+idItem,
                beforeSend:function(){
                    $('.loadingMore').show();
                },
                success:function(html){
                    $('.loadingMore').remove();
                    $('.main').append(html);
                }
            });
        }
        idOld = idItem;
        console.log(idOld);
        */
    });
    
    //link to another page like href
    linkItem.click(function(){
        var link = $(this).attr('data-link');
        if($('.fadeInElement').length){
               closeViewUI();
        } else {
            body.addClass('loader');
            setTimeout(function(){
                window.open(link, "_self");
            }, 450);
        }
    });
    
    openView.click(function(){
        var link = $(this).attr('data-link');
        body.addClass('loader');
        setTimeout(function(){
            openViewUI(link);
        }, 450);
    });
    
    openViewOption.click(function(){
        var link = $(this).attr('data-link');
        view.show();
        mainView.load(link);
        mainView.addClass('mainViewOption').removeClass('mainView');
        mainView.addClass('fadeInElement').removeClass('hidden');
    });
    
    $(closeViewArea).click(function(){
        closeViewUI();
    });
    
    function openViewUI(link){
        view.show();
        mainView.load(link);
        mainView.addClass('fadeInElement').removeClass('hidden');
        body.removeClass('loader').addClass('fixed');
    }
    
    function closeViewUI(){
        mainView.addClass('fadeOutElement').removeClass('fadeInElement');
        body.addClass('loader');
        setTimeout(function(){
            body.removeClass('loader').removeClass('fixed');
            mainView.addClass('hidden').removeClass('fadeOutElement');
            mainView.addClass('mainView').removeClass('mainViewOption');
            $(view).hide();
            }, 450);
    }
    
    function addScrollText(){
        fullText.each(function(){
            if($(this).width() > screenX-65){
                console.log("Added textScroll class to fullText");
                $(this).addClass('textScroll');
            } else $(this).removeClass('textScroll');
        });
    }
});