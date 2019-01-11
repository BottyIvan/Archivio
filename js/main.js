$(document).ready(function () { 

    var body = $('body'),
        linkItem = $('.linkItem'),
        openView = $('.openView'),
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