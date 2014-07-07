
        @if(Config::get('app.use_scripts_local'))
        	{{ HTML::scriptmod('js/vendor/jquery.min.js') }}
        @else
            {{ HTML::script("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js") }}
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        @endif

        {{ HTML::script("//ulogin.ru/js/ulogin.js") }}

        {{ HTML::scriptmod('js/vendor/jquery.countdown.min.js') }}
        <script type="text/javascript">
            $('#timer').countdown('2014/07/16', function(event) {
                var totalHours = event.offset.totalDays * 24 + event.offset.hours;
                $(this).html(event.strftime('<div class="hours">' + totalHours + '</div>' + ':' + '<div class="mins">%M</div>:<div class="secs">%S</div> '));
            });

            var advice_id = '{{ Input::get('advice') }}';
        </script>

        {{ HTML::scriptmod("js/plugins.js") }}
        {{ HTML::scriptmod("js/main.js") }}

        <script>
            var rootElems; 
    
            $(function(){
                fotoramaInit();
                rootElems = navInit();
                console.log(rootElems);
            });
    
            function navInit() {
                var rootElems = $('#instaSlider .insta-slide').clone();
                var elems = rootElems.filter('[data-taste="0"]').clone().empty();
                var parent = $('#instaNavSlider');
                parent.append(elems);
                
                jCarouselInit( $('.jcarousel'), $('.jcarousel-vert'), $('.jcarousel-control-prev'), $('.jcarousel-control-next'), $('.jcarousel-vert-control-prev'), $('.jcarousel-vert-control-next') );
                jCarouselInit( $('.jcarousel2'), $('.jcarousel-vert2'), $('.jcarousel-control-prev2'), $('.jcarousel-control-next2'), $('.jcarousel-vert-control-prev2'), $('.jcarousel-vert-control-next2') );
    
                return rootElems;
            };    
        </script>

        {{ HTML::scriptmod("js/vendor/fotorama.js") }}
        <script>
            function fotoramaInit() {
                var parent = $('.fotorama').fotorama({
                    arrows: false,
                    nav: false,
                    height: '280',
                    autoplay: '3500',
                    transition: 'crossfade'
                });
            }
        </script>
    
        {{ HTML::scriptmod("js/vendor/jcarousel.js") }}
        <script>
            //Bounded slider for instagram photos
            function jcarouselLoad(taste) {
                var elems = rootElems.filter('[data-taste="' + taste + '"],[data-taste="-1"]');
    
                $('#instaSlider, #instaNavSlider').empty();
    
                $('#instaSlider').append(elems.clone());
                $('#instaNavSlider').append(elems.clone().empty());
    
                $('.jcarousel, .jcarousel-vert').jcarousel('destroy');    
                
                jCarouselInit( $('.jcarousel'), $('.jcarousel-vert'), $('.jcarousel-control-prev'), $('.jcarousel-control-next'), $('.jcarousel-vert-control-prev'), $('.jcarousel-vert-control-next') );
            }
            function jCarouselInit(main_car, nav_car, prev_arr, next_arr, next_varr, prev_varr) {
                var connector = function(itemNavigation, carouselStage) {
                    return carouselStage.jcarousel('items').eq(itemNavigation.index());
                };
                var mainCarousel = main_car.jcarousel({
    
                }).jcarousel('scroll', '0');
                var navCarousel = nav_car.jcarousel({
                    vertical: true
                }).jcarousel('scroll', '0');
                navCarousel.jcarousel('items').each(function() {
                    var item = $(this);
    
                    // This is where we actually connect to items.
                    var target = connector(item, mainCarousel);
    
                    item
                        .on('jcarouselcontrol:active', function() {
                            navCarousel.jcarousel('scrollIntoView', this);
                            item.addClass('active');
                        })
                        .on('jcarouselcontrol:inactive', function() {
                            item.removeClass('active');
                        })
                        .jcarouselControl({
                            target: target,
                            carousel: mainCarousel
                        });
                });
                prev_arr
                    .on('jcarouselcontrol:active', function() {
                        $(this).removeClass('inactive');
                    })
                    .on('jcarouselcontrol:inactive', function() {
                        $(this).addClass('inactive');
                    })
                    .jcarouselControl({
                        target: '-=1'
                    });
                /* Main Carousel Controls */
                next_arr
                    .on('jcarouselcontrol:active', function() {
                        $(this).removeClass('inactive');
                    })
                    .on('jcarouselcontrol:inactive', function() {
                        $(this).addClass('inactive');
                    })
                    .jcarouselControl({
                        target: '+=1'
                    });
    
                prev_varr
                    .on('jcarouselcontrol:inactive', function() {
                        $(this).addClass('inactive');
                    })
                    .on('jcarouselcontrol:active', function() {
                        $(this).removeClass('inactive');
                    })
                    .jcarouselControl({
                        target: '+=1'
                    });
                /* Nav Carousel Controls */
                next_varr
                    .on('jcarouselcontrol:inactive', function() {
                        $(this).addClass('inactive');
                    })
                    .on('jcarouselcontrol:active', function() {
                        $(this).removeClass('inactive');
                    })
                    .jcarouselControl({
                        target: '-=1'
                    });
            };
    
            $fotoramaCont = $('.advice-fotorama');
            $fotoramaContElems = {};
            $fotoramaCont.each( function(){
                $fotoramaContElems[''+$(this).data('taste')] = $(this).find('.slide');
            });
            console.log($fotoramaContElems);
    
            var $popupTwitter = $('#Twitter').fotorama({
                nav: false,
                width: '848',
                height: '300',
                arrows: 'always'
            });

            var $popupFotorama = $('.advice-fotorama').fotorama({
                nav: false,
                width: '848',
                height: '550',
                arrows: 'always'
            });
            var $popupFotoramaApi = $popupFotorama.data('fotorama');
            
            $popupFotorama.on(
              'fotorama: show fotorama:showend',
              function (e, fotorama, extra) {
                var index = $('.popup-fotorama .fotorama__active .slide').data('taste');
              }
            );
            
            var $miniFotorama = $('#miniSlider').fotorama({
                nav: false,
                autoplay: false,
                arrows: 'always'
            });
    
            var miniLoadCD = 0;
    
            $miniFotorama.on(
              'fotorama: show fotorama:showend',
              function (e, fotorama, extra) {
                var superIndex = $('.ice-cream-slider .slide.active').data('taste');
                var index = $('#miniSlider .fotorama__active .slide').data('taste');
                $('#miniSlider').attr('data-taste', index);
                $('#popupCont').attr('data-taste', index);
                
                if(!miniLoadCD) {
                    fotorama.show(superIndex);
                    miniLoadCD = 1;
                }
    
                setTimeout( function(){
                    $('.cat-li[data-filter="' + activeFilter + '"]').trigger('click');
                    console.log('triggered');
                }, 50);
                
              }
            ); 
    
            var $photoMiniFotorama = $('#photoMiniSlider').fotorama({
                nav: false,
                autoplay: false,
                arrows: 'always'
            }); 
    
            $photoMiniFotorama.on(
                'fotorama: show fotorama:showend',
                function (e, fotorama, extra) {
                    var superIndex = $('.ice-cream-slider .slide.active').data('taste');
                    var index = $('#photoMiniSlider .fotorama__active .slide').data('taste');
                    $('#photoMiniSlider').attr('data-taste', index);
                    $('#photoPopupCont').attr('data-taste', index);
                    $('.jcarousel-vert-control').attr('data-taste', index);
                    $('#photoPopupCont .popup-headdesc span').addClass('hidden');
                    $('#photoPopupCont .popup-headdesc span[data-taste="' + index + '"]').removeClass('hidden');
                    jcarouselLoad(index);
                }
            );
        </script>
    
    
        {{ HTML::scriptmod("js/libs/jquery-form.min.js") }}
        {{ HTML::scriptmod("js/libs/upload.js") }}

        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-52189500-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
