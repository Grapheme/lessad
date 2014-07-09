var MenuLine = (function(){

	var transform = function(left, width) {
		var str = "-webkit-transform: translateX(" + left + "px); transform: translateX(" + left + "px); width:" + width + "px;";
		return str;
	}

	var set = function(left, width) {
		$('.nav-line .line').attr('style', transform(left, width));
	}
	
	var init = function() {
		var active = $('.nav-main a.active');
		if(active.length == 0) {
			var width = 0;
			var left = 0;
		} else {
			var width = active.width();
			var left = active.position().left + parseInt(active.css('padding-left'));
		}
		set(left, width);
	}

	$(document).on('mouseover', '.nav-main a', function(){
		var left = $(this).position().left + parseInt($(this).css('padding-left'));
		var width = $(this).width();
		set(left, width);
	});

	$(document).on('mouseout', '.nav-main a', function(){
		init();
	});

	$(function(){
		init();
	});

})();

var List = (function(){

	$('.us-page ol').each(function(){
		var i = 1;
		$(this).find('li').each(function(){
			$(this).attr('data-number', i);
			i++;
		});
	});

})();

var Parallax = (function(){

	var init = function() {
		if($('.parallax').length == 0) return;

		var parPos = [];
		
		parPos[0] = $('.par-item').eq(0).offset().top;
		parPos[1] = $('.par-item').eq(1).offset().top;

		$(window).on('scroll', function(){
			var scrollDown = $(window).scrollTop() + $(window).height();
			console.log(parPos[0]);
			if(parPos[0] < scrollDown) {
				console.log(2);
			}
		});
	}

	$(function(){
		init();
	});

})();