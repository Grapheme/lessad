<?php

class ReviewsController extends \BaseController {

    public static $name = 'reviews_public';
    public static $group = 'reviews';

    public static $prefix_url = FALSE;

    public static function returnRoutes($prefix = null) {

        if (self::$prefix_url !== FALSE):
            if (is_array(Config::get('app.locales')) && count(Config::get('app.locales'))) {
                foreach(Config::get('app.locales') as $locale) {
                    Route::group(array('before' => 'i18n_url', 'prefix' => $locale), function(){
                        Route::get('/'.self::$prefix_url.'/{url}', array('as' => 'reviews_full', 'uses' => __CLASS__.'@showFullByUrl'));
                    });
                }
            }
            Route::group(array('before' => 'i18n_url'), function(){
                Route::get('/'.self::$prefix_url.'/{url}', array('as' => 'reviews_full', 'uses' => __CLASS__.'@showFullByUrl'));
            });
        else:
            return NULL;
        endif;

    }

    public static function returnShortCodes() {

        $tpl = static::returnTpl();

        shortcode::add("reviews",

            function($params = null) use ($tpl) {
                #print_r($params); die;
                ## Gfhfvtnhs по-умолчанию
                $default = array(
                    'tpl' => Config::get('app-default.news_template'),
                    'limit' => Config::get('app-default.news_count_on_page'),
                    'order' => Helper::stringToArray(I18nNews::$order_by),
                    'pagination' => 1,
                );
                ## Применяем переданные настройки
                $params = array_merge($default, $params);
                #dd($params);

                #if(Allow::enabled_module('i18n_news')):
                ## Получаем новости, делаем LEFT JOIN с news_meta, с проверкой языка и тайтла
                $selected_news = I18nNews::where('i18n_news.publication', 1)
                    ->leftJoin('i18n_news_meta', 'i18n_news_meta.news_id', '=', 'i18n_news.id')
                    ->where('i18n_news_meta.language', Config::get('app.locale'))
                    ->where('i18n_news_meta.title', '!=', '')
                    ->select('*', 'i18n_news.id AS original_id', 'i18n_news.published_at AS created_at')
                    ->orderBy('i18n_news.published_at', 'desc');

                #$selected_news = $selected_news->where('i18n_news_meta.wtitle', '!=', '');

                ## Получаем новости с учетом пагинации
                #echo $selected_news->toSql(); die;
                #var_dump($params['limit']);
                $news = $selected_news->paginate($params['limit']); ## news list with pagination
                #$news = $selected_news->get(); ## all news, without pagination

                foreach ($news as $n => $new) {
                    #print_r($new); die;
                    $gall = Rel_mod_gallery::where('module', 'news')->where('unit_id', $new->original_id)->first();
                    #foreach ($gall->photos as $photo) {
                    #	print_r($photo->path());
                    #}
                    #print_r($gall->photos); die;
                    $new->gall = @$gall;
                    $new->image = is_object(@$gall->photos[0]) ? @$gall->photos[0]->path() : "";
                    $news[$n]->$new;
                }

                #echo $news->count(); die;

                if($news->count()) {

                    #if(empty($params['tpl']) || !View::exists($this->tpl.$params['tpl'])) {
                    if(empty($params['tpl']) || !View::exists($tpl.$params['tpl'])) {
                        #return App::abort(404, 'Отсутствует шаблон: ' . $this->tpl . $i18n_news->template);
                        #return "Отсутствует шаблон: templates.".$params['tpl'];
                        throw new Exception('Template not found: ' . $tpl.$params['tpl']);
                    }

                    return View::make($tpl.$params['tpl'], compact('news'));
                }
                #else:
                #	return '';
                #endif;
            }
        );

    }

    public function __construct(I18nNews $news, I18nNewsMeta $news_meta){

        View::share('module_name', self::$name);

        $this->tpl = $this->gtpl = static::returnTpl();
        View::share('module_tpl', $this->tpl);
        View::share('module_gtpl', $this->gtpl);
    }

    public function showFullByUrl($url){

        if (!@$url)
            $url = Input::get('url');

        if(!Allow::enabled_module('i18n_news'))
            return App::abort(404);

        $i18n_news = I18nNews::where('slug', $url)->where('publication', 1)->first();

        if (!$i18n_news)
            return App::abort(404);

        if(empty($i18n_news->template) || !View::exists($this->tpl.$i18n_news->template)) {
            #return App::abort(404, 'Отсутствует шаблон: ' . $this->tpl . $i18n_news->template);
            throw new Exception('Template not found: ' . $this->tpl.$i18n_news->template);
        }

        $i18n_news_meta = I18nNewsMeta::where('news_id', $i18n_news->id)->where('language', Config::get('app.locale'))->first();

        if(!$i18n_news_meta || !$i18n_news_meta->title)
            return App::abort(404);

        $gall = Rel_mod_gallery::where('module', 'news')->where('unit_id', $i18n_news->id)->first();

        /**
         * @todo После того, как будет сделано управление модулями (актив/неактив) - поменять условие, активен ли модуль страниц
         */
        if ( method_exists('PagesController', 'content_render') ) {
            $i18n_news_meta->preview = PagesController::content_render($i18n_news_meta->preview);
            $i18n_news_meta->content = PagesController::content_render($i18n_news_meta->content);
        }

        return View::make($this->tpl.$i18n_news->template,
            array(
                'new' => $i18n_news,
                'news'=>$i18n_news_meta,
                'page_title'=>$i18n_news_meta->seo_title,
                'page_description'=>$i18n_news_meta->seo_description,
                'page_keywords'=>$i18n_news_meta->seo_keywords,
                'page_author'=>'',
                'page_h1'=>$i18n_news_meta->seo_h1,
                'menu'=> Page::getMenu('news'),
                'gall' => $gall
            )
        );
    }
}