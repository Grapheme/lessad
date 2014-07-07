<?
$brand_advice_taste = ExtremBrandAdvice::orderBy('taste', 'ASC')->select('taste')->distinct()->get();


$blogger_advices = ExtremBloggerAdvice::take(10)->get();

$user_photos = UserPhoto::where('approved', 1)->orderBy('updated_at', 'DESC')->take(Config::get('site.limit_moderated_photos_popup'))->get();
#Helper::dd($user_photos);

$twitter = Twitter::where('status', 1)->orderBy('updated_at', 'DESC')->take(Config::get('site.limit_moderated_twitter'))->get();
#Helper::dd($twitter);

$number_tweets = 5; 

/*
$hashtags = array(
    'passionhour',
    'ЧасСтрасти',
    'hourofpassion',
    'ЯркаяСтрасть',
    'УтренняяСтрасть',
    'ДразнящаяСтрасть',
    'ЭкзотикаСтрасти',
    'ИзысканнаяСтрасть',
    'ВечнаяСтрасть',
);
#*/

/*
$ch = curl_init();
//set the endpoint url
curl_setopt($ch, CURLOPT_URL, 'https://api.twitter.com/oauth2/token');
// has to be a post
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data = array();
$data['grant_type'] = "client_credentials";
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
// here's where you supply the Consumer Key / Secret from your app:
$consumerKey = 't0iX3noR4eXUBk5U5hPsHoM3O';
$consumerSecret = 'TPZb2IorgYnYs9foCLVge4fF9K6GyyLlOEMFpyu5RfAycFL5vk';           
curl_setopt($ch,CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//execute post
$result = curl_exec($ch);
//close connection
curl_close($ch);
// show the result, including the bearer token (or you could parse it and stick it in a DB)       
Helper::dd($result);
#*/
#/*
function getTweets($hashtag = "passionhour", $amount = 5) {
	$username = 'grapheme_ru';
	#$number_tweets = $amount;
	$feed = "https://api.twitter.com/1.1/search/tweets.json?q=%23".$hashtag."&result_type=recent";

	//$cache_file = '/srv/www/extreme_hour/tmp/twitter-cache';
	#$cache_file = getcwd().'/cache/twitter-cache-'.md5($hashtag);
	$cache_file = Config::get('site.tmp_dir').'/twitter-cache-'.md5($hashtag);
	$modified = @filemtime( $cache_file );
	$now = time();
	$interval = 600; // ten minutes

	// check the cache file
	if ( !$modified || ( ( $now - $modified ) > $interval ) ) {
	  $bearer = 'AAAAAAAAAAAAAAAAAAAAAHAEYQAAAAAAaPcpRqKG0KqFtpC7980ytxxx6cw%3DIux7SHjxOxcnjJfuXsGkEsPJ8sG8xCHcbDfdWPVorpcQuCEs8r';
	  $context = stream_context_create(array(
	    'http' => array(
	      'method'=>'GET',
	      'header'=>"Authorization: Bearer " . $bearer
	      )
	  ));
	  
	  $json = file_get_contents( $feed, false, $context );
	  
	  if ( $json ) {
	    $cache_static = fopen( $cache_file, 'w' );
	    fwrite( $cache_static, $json );
	    fclose( $cache_static );
	  }
	}

	$json = file_get_contents( $cache_file );

	return json_decode($json);
}
#*/
?>


        </div>
        <div id="load-overlay" class="overlay hidden">
            <div class="popup advice-popup hidden" data-popup="1">
                <div class="popup-head">
                    <div class="mini-logo"></div>
                    <div id="miniSlider" class="mini-slider" data-auto="false">
                        <div class="slide slide-1" data-taste="0" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                            <div class="mini-desc">Клубника</div>
                        </div>
                        <div class="slide slide-2" data-taste="1" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                            <div class="mini-desc">Фисташка</div>
                        </div>
                        <div class="slide slide-3" data-taste="2" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                            <div class="mini-desc">Тропик</div>
                        </div>
                        <div class="slide slide-4" data-taste="3" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                            <div class="mini-desc">Ямбери</div>
                        </div>
                        <div class="slide slide-5" data-taste="4" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                            <div class="mini-desc">Два шоколада</div>
                        </div>
                        <div class="slide slide-6" data-taste="5" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                            <div class="mini-desc">Ягодный</div>
                        </div>
                    </div>
                    <div class="popup-close"></div>
                </div>
                <div class="popup-body" id="popupCont">
                    <ul class="cats">
                        <li class="cat-li cat-adv active" data-filter="1">
                            Советы
                        </li>
                        <li class="cat-li cat-dan" data-filter="2">
                            Танцы
                        </li>
                        <li class="cat-li cat-fil" data-filter="3">
                            Фильмы
                        </li>
                    </ul>
                    <header class="popup-header">
                        <div data-filter="1">
                            <h2>Extreme советы</h2>
                            <div class="popup-headdesc">
                                Наши советы о том, как можно провести «Час Страсти»
                            </div>
                        </div>
                        <div class="hidden" data-filter="2">
                            <h2>Танцы</h2>
                            <div class="popup-headdesc">                                
                                Нет лучшего воплощения страсти, чем танец. Выбирай свой!
                            </div>
                        </div>
                        <div class="hidden" data-filter="3">
                            <h2>Фильмы</h2>
                            <div class="popup-headdesc">
                                Выбор Extreme – Самые страстные фильмы всех времен.
                            </div>
                        </div>
                    </header>
                    <div class="popup-content">
                        <div class="popup-fotorama">

                        @foreach ($brand_advice_taste as $t => $taste)

                            <div class="advice-fotorama" data-taste="{{ $taste->taste }}">

<?
                            $brand_advices = ExtremBrandAdvice::where('taste', $taste->taste)->orderBy('cat', 'ASC')->get();
?>
                            @foreach ($brand_advices as $a => $advice)

                                <div class="slide slide-{{ ($a+1) }}<?if($advice->cat==3){echo ' movie';}?>" data-taste="{{ $advice->taste }}" data-filter="{{ $advice->cat }}">

                                    {{ $advice->desc }}

                                </div>

                            @endforeach

                            </div>

                        @endforeach

                        </div>                        
                    </div>
                    <footer class="popup-footer">
                        <script type="text/javascript" src="http://yandex.st/share/share.js" charset="utf-8"></script>
                        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,odnoklassniki" data-yashareTheme="counter"></div> 
                    </footer>
                </div>
            </div>
        <div class="popup advice-popup pad-popup hidden" data-popup="2">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <!--<div class="mini-slider">
                    <div class="slide slide-1" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Клубника</div>
                    </div>
                    <div class="arr arr__left"><span class="icon icon-left-dir"></span></div>
                    <div class="arr arr__right"><span class="icon icon-right-dir"></span></div>
                </div>-->
                <div class="popup-close"></div>
            </div>
            <div class="popup-body clearfix">

                @foreach($blogger_advices as $a => $advice)
                <div class="column-content<?=($a>0?' hidden':'')?>">
                    <div class="content-image">
                        <? $photo = $advice->photo(); ?>
                        @if (is_object($photo))
                        <? $photo = $photo->full(); ?>
                        <img src="{{ $photo }}" alt="Час Страсти" />
                        @endif
                        <div class="content-title">
                            @if ($advice->title)
                            {{ $advice->title }}
                            @else
                            {{ $advice->author }}
                            @endif
                        </div>
                        <div class="content-info taste-{{ $advice->taste }}">
                            <span class="content-author">
                                {{ $advice->author }}
                            </span>
                            <span class="content-date">
                                {{ Helper::rdate("j M Y", $advice->created_at) }}
                            </span>
                        </div>
                    </div>
                    <div class="content-text">
                        {{ $advice->desc }}
                    </div>
                    <div class="content-social advice-shares">
                        <a href="#" class="vk-share" onclick="Share.vkontakte('http://{{ $_SERVER['HTTP_HOST'] }}/main?advice={{ $advice->id }}','eXtreme','','')"><span class="icon icon-vkontakte-rect"></span></a>
                        <a href="#" class="fb-share" onclick="Share.facebook('http://{{ $_SERVER['HTTP_HOST'] }}/main?advice={{ $advice->id }}','eXtreme','','')"><span class="icon icon-facebook-squared"></span></a>
                        <a href="#" class="od-share" onclick="Share.odnoklassniki('http://{{ $_SERVER['HTTP_HOST'] }}/main?advice={{ $advice->id }}','eXtreme')"><span class="icon icon-odnoklassniki-rect"></span></a>
                    </div>
                </div>
                @endforeach

                <div class="column-list">
                    <div class="list-title">Другие статьи</div>
                    <ul>
                        @foreach($blogger_advices as $a => $advice)
                        <li<?=($a==0?' style="display: none;"':'')?> data-advice="{{ $advice->id }}">
                            <h3>
                                @if ($advice->title)
                                {{ $advice->title }}
                                @else
                                {{ $advice->author }}
                                @endif
                            </h3>
                            <div class="list-item-info clearfix taste-{{ $advice->taste }}">
                                <span class="list-author">
                                    {{ $advice->author }}
                                </span>
                                <span class="list-date">
                                    {{ Helper::rdate("j M Y", $advice->created_at) }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="popup photo-popup hidden" data-popup="3">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <div class="mini-slider" id="photoMiniSlider" data-auto="false">
                    <div class="slide slide-1" data-taste="0" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Клубника</div>
                    </div>
                    <div class="slide slide-2" data-taste="1" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Фисташка</div>
                    </div>
                    <div class="slide slide-3" data-taste="2" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Тропик</div>
                    </div>
                    <div class="slide slide-4" data-taste="3" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Ямбери</div>
                    </div>
                    <div class="slide slide-5" data-taste="4" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Два шоколада</div>
                    </div>
                    <div class="slide slide-6" data-taste="5" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Ягодный</div>
                    </div>
                </div>
                <div class="popup-close"></div>
            </div>
            <div class="popup-body" id="photoPopupCont">
                <header class="popup-header">
                    <h2>#Часстрасти</h2>
                    <div class="popup-headdesc">
                        Добавляйте свои страстные моменты 
                        в инстаграмм с хэштегом #ЧасСтрасти
                        <span class="slider-tag" data-taste="0">#ЯркаяСтрасть</span><!-- Клубника -->
                        <span class="slider-tag hidden" data-taste="1">#ДразнящаяСтрасть</span><!-- Фисташка -->
                        <span class="slider-tag hidden" data-taste="2">#УтренняяСтрасть</span><!-- Тропик -->
                        <span class="slider-tag hidden" data-taste="3">#ЭкзотикаСтрасти</span><!-- Ямбери -->
                        <span class="slider-tag hidden" data-taste="4">#ВечнаяСтрасть</span><!-- Два шоколада -->
                        <span class="slider-tag hidden" data-taste="5">#ИзысканнаяСтрасть</span><!-- Ягодный -->
                    </div>
                </header>
                <div class="popup-content">
                    <div class="instaphoto-slider jcarousel">
                        <ul id="instaSlider">
                        @foreach ($instagram as $i => $insta)
                            <?
                            $data = json_decode($insta->full, 1);
                            $taste = -1;
                            $tags = $insta->tags;
                            foreach($tags as $t => $tag) {
                                foreach(Config::get('site.taste_hashtags') as $th => $taste_hashtag) {
                                    #echo mb_strtolower($tag->tag) . " == " . mb_strtolower($taste_hashtag);
                                    if(mb_strtolower($tag->tag) == mb_strtolower($taste_hashtag)) {
                                        $taste = $th;
                                        break;
                                    }
                                }
                            }
                            ?>
                            <li class="insta-slide slide-{{ ($i+1) }}" data-taste="{{ $taste }}" style="background:url({{ $insta->image }}) no-repeat center center / cover;">
                                <div class="slide-desc">
                                    <div class="slide-user">{{ $data['user']['full_name'] }}</div>
                                    <div class="slide-description"></div>
                                    <div class="slide-tags">#часстрасти</div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    <a href="#" class="jcarousel-control jcarousel-control-prev"></a>
                    <a href="#" class="jcarousel-control jcarousel-control-next"></a>                        
                </div>
            </div>                
            <div class="instaphoto-slider-vertical jcarousel-vert">
                <ul id="instaNavSlider">
                </ul> 
            </div>                
            <a href="#" class="jcarousel-vert-control jcarousel-vert-control-prev first-vert">
                <span class="icon icon-up-dir"></span>
            </a>
            <a href="#" class="jcarousel-vert-control jcarousel-vert-control-next first-vert">
                <span class="icon icon-down-dir"></span>
            </a>
        </div>
        <div id="load-photo" class="popup app__popup advice-popup pad-popup hidden" data-popup="4">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <div class="popup-close"></div>
            </div>
            <div class="popup-body clearfix">
                <div class="msg-box">
                    <p>
                        Спасибо за участие. Для того, чтобы ваша фотография появилась на сайте, вам необходимо авторизоваться.
                    </p>
                    <p>
                        <!-- тут должны быть кнопки соц. сетей для авторизации -->
                        <!--<div id="uLogin1" data-uloginid="9d764e95"></div>-->
                        <div id="uLogin9d764e95" data-ulogin="display=panel;fields=first_name,last_name,city;optional=photo_big,sex,bdate;providers=vkontakte,facebook,odnoklassniki;redirect_uri=;callback=uloginauth"></div>
                    </p>
                    <p>
                        Внимание! Загружая фотографии на сайт вы подтверждаете, что: <br/>
                        1) На фотографии изображены вы. В таком случае, вы даете свое согласие на размещение вашего изображения на настоящем сайте в рамках проекта «Час страсти», а также на дальнейшее использование изображения компанией Nestle без выплаты вознаграждения. <br/>
                        2) На фотографии изображены лица, от которых (от законных представителей которых) вы получили согласие на использование данного изображения в рамках проекта «Час страсти», а также на дальнейшее использование изображения компанией Nestle без выплаты вознаграждения. <br/>
                        * В любой момент до окончания проекта «Час страсти» вы можете отозвать свое согласие, удалив фотографию с сайта, а после окончания проекта отозвать согласие можно, направив в компанию Nestle письменное уведомление. <br/>
                        3) Все фотографии перед загрузкой на сайт проекта проходят предварительную модерацию и могут быть не загружены на сайт без пояснения причин, например, если такие фотографии не соответствуют тематике проекта «Час страсти», нарушают общепринятые нормы морали и нравственности, плохого качества (нечеткое изображение, маленький формат и т.п.) и по иным причинам на усмотрение модератора. <br/>
                        4) Организаторы проекта «Час страсти» не несут ответственности за все фотоматериалы, размещенные участниками проекта на сайте. Такую ответственность несут персонально участники проекта.
                    </p>
                </div>
                <div class="success-box">
                    <p>
                        <center>Спасибо за участие! Ваша фотография появится на сайте сразу после одобрения модератором.</center>
                    </p>
                </div>
                <div class="photo-border">
                	<div id="HolderPhoto"></div>
                    <div class="photo-frame"> </div>
                    <div class="photo-logo"> </div>
                </div>
                <form id="form-photo-save" method="POST" action="/upload">
					<input type="file" style="width: 1em;" name="file" class="input-photo invisible" id="selectPhoto">
					<input type="hidden" name="profile" value="">
					<button value="send" type="submit2" class="photo-save">Отправить</button>
				</form>
                <a href="javascript:void(0);" class="photo-upload-link select-image">Загрузить другую фотографию</a>
            </div>
        </div>
        
        
        
        <div class="popup advice-popup hidden" data-popup="5">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <div class="popup-close"></div>
            </div>
            <div class="popup-body" id="popupCont">
                <header class="popup-header">
                    <h2>#ЧАССТРАСТИ</h2>
                    <div class="popup-headdesc">
                        Ваши твиты с хэштегом #часстрасти
                    </div>
                </header>
                <div class="popup-content">
                    <div class="popup-fotorama" id="Twitter">
                        <?php
                        /*
                        foreach($hashtags as $hashtag) {
                            $tweets = getTweets($hashtag);
                            #Helper::dd($tweets);
                            foreach($tweets->statuses as $t => $tweet) {
                                if ($t >= $number_tweets)
                                    continue;
                                #Helper::d($tweet);
                                echo '<div class="slide slide-'.$t.'" data-taste="0">'.$tweet->text.'</div>';
                            }
                        }
                        */
                        #dd($twitter);
                        if (is_object($twitter) && count($twitter)) {
                            foreach($twitter as $t => $tweet) {
                                #if ($t >= $number_tweets)
                                #    continue;
                                #Helper::d($tweet);
                                echo '<div class="slide slide-'.$t.'" data-taste="0">'.$tweet['text'].'</div>';
                            }
                        }
                        ?>
                    </div>                        
                </div>
                <footer class="popup-footer">
                    <script type="text/javascript" src="http://yandex.st/share/share.js" charset="utf-8"></script>
                    <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,odnoklassniki" data-yashareTheme="counter"></div> 
                </footer>
            </div>
        </div>


        <div class="popup photo-popup hidden" data-popup="6">
            <div class="popup-head">
                <div class="mini-logo"></div>
                {{--
                <div class="mini-slider">
                    <div class="slide slide-1" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Клубника</div>
                    </div>
                    <div class="arr arr__left"><span class="icon icon-left-dir"></span></div>
                    <div class="arr arr__right"><span class="icon icon-right-dir"></span></div>
                </div>
                --}}
                <div class="popup-close"></div>
            </div>
            <div class="popup-body">
                <header class="popup-header">
                    <h2>ЧАС СТРАСТИ</h2>
                    <div class="popup-headdesc">
                        Ваши фотографии,<br/>
                        загруженные на сайт
                    </div>
                </header>
                <div class="popup-content">
                    <div class="instaphoto-slider jcarousel2">
                        <ul id="photoSlider">

                            @foreach($user_photos as $photo)
                            <? if (strpos($photo->image, " ")) { continue; } ?>
                            <li class="insta-slide slide-1" style="background:url({{ Config::get('site.tmp_public_dir') }}/{{ str_replace(" ", "%20", $photo->image) }}) no-repeat center center / cover;">
                                <div class="slide-desc">
                                    <div class="slide-user"></div>
                                    <div class="slide-description"></div>
                                    <div class="slide-tags"></div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <a href="#" class="jcarousel-control jcarousel-control-prev2"></a>
                    <a href="#" class="jcarousel-control jcarousel-control-next2"></a>                        
                </div>
            </div>                
            <div class="instaphoto-slider-vertical jcarousel-vert2">
                <ul id="photoNavSlider">

                    @foreach($user_photos as $photo)
                    <? if (strpos($photo->image, " ")) { continue; } ?>
                    <li class="insta-slide slide-1" style="background:url({{ Config::get('site.tmp_public_dir') }}/{{ str_replace(" ", "%20", $photo->image) }}) no-repeat center center / cover;">
                        <div class="slide-desc">
                            <div class="slide-user"></div>
                            <div class="slide-description"></div>
                            <div class="slide-tags"></div>
                        </div>
                    </li>
                    @endforeach

                </ul> 
            </div>                
            <a href="#" class="jcarousel-vert-control jcarousel-vert-control-prev2">
                <span class="icon icon-up-dir"></span>
            </a>
            <a href="#" class="jcarousel-vert-control jcarousel-vert-control-next2">
                <span class="icon icon-down-dir"></span>
            </a>
        </div>


    </div>