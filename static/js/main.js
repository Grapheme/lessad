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
		var width = active.width();
		var left = active.position().left + parseInt(active.css('padding-left'));
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

	init();
})();