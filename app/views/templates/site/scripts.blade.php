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
    if (typeof runFormValidation === 'function') {
        loadScript("{{asset('js/vendor/jquery-form.min.js');}}", runFormValidation);
    } else {
        loadScript("{{asset('js/vendor/jquery-form.min.js');}}");
    }
</script>
<script type='text/javascript'>

    (function () {
        var widget_id = 'DHYcVbBdhG';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = '//code.jivosite.com/script/widget/' + widget_id;
        var ss = document.getElementsByTagName('script')[0];
        ss.parentNode.insertBefore(s, ss);
    })();
</script>
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter28966135 = new Ya.Metrika({
                    id: 28966135,
                    webvisor: true,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true
                });
            } catch (e) {
            }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="//mc.yandex.ru/watch/28966135" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>