<?php

class NewsController extends BaseController {

    public static $name = 'news_public';
    public static $group = 'news';

    public static $prefix_url = 'blog';

    public static function returnRoutes($prefix = null) {

        if (self::$prefix_url !== FALSE):
            if (is_array(Config::get('app.locales')) && count(Config::get('app.locales'))) {
                foreach(Config::get('app.locales') as $locale) {
                    Route::group(array('before' => 'i18n_url', 'prefix' => $locale), function(){
                        Route::get('/'.self::$prefix_url.'/{url}', array('as' => 'news_full', 'uses' => __CLASS__.'@showFullByUrl'));
                    });
                }
            }
            Route::group(array('before' => 'i18n_url'), function(){
                Route::get('/'.self::$prefix_url.'/{url}', array('as' => 'news_full', 'uses' => __CLASS__.'@showFullByUrl'));
            });
        else:
            return NULL;
        endif;

    }
    
    ## Shortcodes of module
    public static function returnShortCodes() {

        $tpl = static::returnTpl();

    	shortcode::add("news",
        
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

    public static function returnActions() {
        return NULL;
    }

    public static function returnInfo() {
        return NULL;
    }

    /****************************************************************************/

	public function __construct(I18nNews $news, I18nNewsMeta $news_meta){

        View::share('module_name', self::$name);

        $this->tpl = $this->gtpl = static::returnTpl();
        View::share('module_tpl', $this->tpl);
        View::share('module_gtpl', $this->gtpl);
	}
    
    public function showFullByUrl($url){

        if(!Allow::enabled_module('news'))
            return App::abort(404);

        if($news = I18nNews::where('slug', $url)->where('publication', 1)->with('meta')->with('photo')->first()):
            if(empty($news->template) || !View::exists($this->tpl.$news->template)):
                throw new Exception('Template not found: ' . $this->tpl.$news->template);
            endif;

            if(method_exists('PagesController','content_render')):
                $news->meta->first()->preview = PagesController::content_render($news->meta->first()->preview);
                $news->meta->first()->content = PagesController::content_render($news->meta->first()->content);
            endif;

            return View::make($this->tpl.$news->template,
                array(
                    'news' => $news,
                    'page_title'=>$news->meta->first()->seo_title,
                    'page_description'=>$news->meta->first()->seo_description,
                    'page_keywords'=>$news->meta->first()->seo_keywords,
                    'page_author'=>'',
                    'page_h1'=>$news->meta->first()->seo_h1,
                    'menu'=> NULL,
                )
            );
        else:
            App::abort(404);
        endif;







	}

}