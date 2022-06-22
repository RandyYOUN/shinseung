

$(function () {
    $(".gnbwrap ul li div").hide();
    $(".gnbwrap > ul > li > a").bind("mouseenter focus", function () {
        $(this).parent().siblings().find("div").hide();
        $(this).next("div").show();
        $(this).parent().addClass("on");
    });
    $(".gnbwrap > ul > li").mouseleave(function () {
        $(this).find("div").hide();
        $(this).removeClass("on");

    });
});


$(function(){
	$(".gnbwrap ul li div").hide();
	$(".gnbwrap > ul > li > a").bind( "mouseenter focus", function() {
		$(this).parent().siblings().find("div").hide();
		$(this).next("div").show();
		$(this).parent().addClass("on");	
	});
	$(".gnbwrap > ul > li").mouseleave(function() {
		$(this).find("div").hide();
		$(this).removeClass("on");
		
	});
});




$(function () {
    //custom selectbox
    
	var select = $('select');
    for (var i = 0; i < select.length; i++) {
        var idxData = select.eq(i).children('option:selected').text();
        select.eq(i).siblings('label').text(idxData);
    }
    select.change(function () {
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });

});

