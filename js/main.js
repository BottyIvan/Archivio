$(document).ready(function () { 

    var body = $('body'),
        formSearch = $('.formSearch'),
        linkItem = $('.linkItem'),
        openView = $('.openView'),
        openViewOption = $('.openViewOption'),
		openItemFromURL = $('.openItemFromURL'),
        fullText = $('.fullText'),
        view = $('.view'),
        closeViewArea = $('.closeViewArea'),
        mainView = $('.mainView'),
		navItem = $('.navItem'),
        screenY = $( window ).height(),
        screenX = $( window ).width();
    
    console.log("window height: "+screenY);
	console.log("window width: "+screenX);
     
	var app = {
		home : '/archivio/include/home.php',
		basket : '/archivio/?bucket=s',
		addItem : '/archivio/include/add_item.php',
		settings : '/archivio/include/settings.php',
		noAvailable: '/archivio/?available=false'
	};
	
	
	/*navItem.each(function(){
		var item = $(this);
		item.on('click', function(){
			$('.main > *').remove();
			$('.main').load(item.attr('data-link'));
		});
	});*/
	
    addScrollText();
    
	$( window ).resize(function() {
	  	console.log("window resized");
	  	screenY = $( window ).height();
        screenX = $( window ).width();
        
        addScrollText();
    });
	
	if(openItemFromURL.length){
		var link = $(this).attr('data-link');
        body.addClass('loader');
        setTimeout(function(){
            openViewUI(link);
        }, 450);
	}
    
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
    
	function changeUrl(url){
		var mUrl = 'http://www.thomasmaneggia.it/archivio/'+url;
		window.history.pushState('data','Title',mUrl);
	}
	
    function openViewUI(link){
        view.show();
        mainView.load(link);
        mainView.addClass('fadeInElement').removeClass('hidden');
        body.removeClass('loader').addClass('fixed');
		formSearch.hide();
		changeUrl(link);
    }
    
    function closeViewUI(){
        mainView.addClass('fadeOutElement').removeClass('fadeInElement');
        body.addClass('loader');
        setTimeout(function(){
            body.removeClass('loader').removeClass('fixed');
            mainView.addClass('hidden').removeClass('fadeOutElement');
            mainView.addClass('mainView').removeClass('mainViewOption');
			formSearch.show();
			changeUrl('?init=1');
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