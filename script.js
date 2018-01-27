
/*var cookies = document.cookie.split(";");
for(i=0;i<cookies.length;i++)
{
    var cookie = cookies[i].split("=");
    if(cookie[1]=="lock")
    {
        $('button'+cookie[0]).html('<i class="fa fa-lock" aria-hidden="true"></i>');
        $('div'+cookie[0]).css('display', 'block');
    }
    if(cookie[1]=="unlock")
    {
        $('button'+cookie[0]).html('<i class="fa fa-unlock" aria-hidden="true"></i>');
        $('div'+cookie[0]).css('display', 'none');
    }
    
}*/



$(document).ready(function () {
    
    
    function dynamicSize()
    {
        $("div.image img").each(function () {
            var height  =parseInt($(this).css('width'))*2/3;
            $(this).css("height", height+"px");
        });
        
        
        var h = (7/16)*parseInt($('#iframe').width());
        $('#iframe').css('height', (h+'px'));
                
        setTimeout(function(){
            $("div.locker-div").each(function () {
            $(this).css("width", $(this).parents().css('width'));
            $(this).css("height", $(this).parents().css('height'));      
            });
        }, 1000);

        setTimeout(function(){
            $("div.locker-video").each(function () {
            $(this).css("width", $(this).parents().css('width'));
            var height = parseInt($(this).parents().css('height'))-50;
            $(this).css("height", height);      
            });
        }, 1000);
        
                 
    }
    dynamicSize();
    if($(window).width() > 991)
    {
        $("div#lock-videos").css('display', 'block');
        $("button.lock-button#lock-videos").html('<i class="fa fa-lock" aria-hidden="true"></i>');
    }

    
    $("button.lock-button").click(function () {
        var id = '#' + this.id;
        var display = $("div" + id).css('display');
        if (display == "block") {
            $("div" + id).css('display', 'none');
            $(this).html('<i class="fa fa-unlock" aria-hidden="true"></i>');
            document.cookie = id+"=unlock";
            
        } else {
            $("div" + id).css('display', 'block');
            $(this).html('<i class="fa fa-lock" aria-hidden="true"></i>');
            document.cookie = id+"=lock";
        }
        

    });

    
    $("button#max-width-button").click(function(){
        
            var parentPage = $(this).parents(".container-fluid");
            var sidebar = parentPage.children("#sidebar");
            var content = parentPage.children("#content");
            var suggestion = parentPage.children("#suggestion");
        
        if($(this).attr('class')=='pull-left hidden-sm hidden-xs')
        {
            $(this).attr('class','pull-left hidden-sm hidden-xs in');
            sidebar.addClass('hidden');
            suggestion.addClass('hidden');    
            content.attr('class','col-md-12');
            sidebar.before(content);
//            var h = (7/16)*($('#iframe').width());
//            $('#iframe').css('height', (h+'px'));
            //$('#lock').css('height',h+"px");
        }
        else if($(this).attr('class')=='pull-left hidden-sm hidden-xs in')
        {
            $(this).attr('class','pull-left hidden-sm hidden-xs');
            sidebar.removeClass('hidden');
            suggestion.removeClass('hidden');    
            content.attr('class','col-xs-12 col-sm-12 col-md-6');
            content.before(sidebar);
//            var h = (7/16)*($('#iframe').width()); 
//            $('#iframe').css('height', (h+'px'));
            //$('#lock').css('height',h+"px");      
        }
        dynamicSize();
        
    })
    
    addEventListener('resize',dynamicSize,false);
});
