@if(Config::get('app.use_scripts_local'))
	{{HTML::script('js/vendor/jquery.min.js');}}
@else
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery.min.js');}}"><\/script>')</script>
@endif
	{{HTML::script('js/system/main.js');}}
	{{HTML::script('js/vendor/SmartNotification.min.js');}}
	{{HTML::script('js/vendor/jquery.validate.min.js');}}
	{{HTML::script('js/system/app.js');}}
	<script type="text/javascript">
		if(typeof runFormValidation === 'function'){
			loadScript("{{asset('js/vendor/jquery-form.min.js');}}",runFormValidation);
		}else{
			loadScript("{{asset('js/vendor/jquery-form.min.js');}}");
		}
	</script>
	
	<!-- BEGIN JIVOSITE CODE {literal} -->

	<script type='text/javascript'>

		(function(){ var widget_id = 'DHYcVbBdhG';

		var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//
		code.jivosite.com/script/widget/'+widget_id
		; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();

	</script>

	<!-- {/literal} END JIVOSITE CODE -->