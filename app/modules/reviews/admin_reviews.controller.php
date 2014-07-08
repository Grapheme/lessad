<?php

class AdminReviewsController extends BaseController {

    public static $name = 'reviews';
    public static $group = 'reviews';

    /****************************************************************************/
    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        Route::group(array('before' => 'auth', 'prefix' => $prefix), function() use ($class) {
            Route::controller($class::$group, $class,array('except'=>'show'));
        });
    }

    ## Shortcodes of module
    public static function returnShortCodes() {

    }

    ## Actions of module (for distribution rights of users)
    ## return false;   # for loading default actions from config
    ## return array(); # no rules will be loaded
    public static function returnActions() {
        return array(
            'view'   => 'Просмотр',
            'create' => 'Создание',
            'edit'   => 'Редактирование',
            'delete' => 'Удаление',
        );
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
        return array(
            'name' => self::$name,
            'group' => self::$group,
            'title' => 'Отзывы',
            'visible' => 1,
        );
    }

    ## Menu elements of the module
    public static function returnMenu() {
        return array(
            array(
                'title' => 'Отзывы',
                'link' => self::$group,
                'class' => 'fa-comments-o',
                'permit' => 'view',
            ),
        );
    }

    /****************************************************************************/
    protected $review;

    public function __construct(Reviews $review){

        $this->review = $review;
        $this->beforeFilter('reviews');
        $this->locales = Config::get('app.locales');

        View::share('module_name', self::$name);

        $this->tpl = static::returnTpl('admin');
        $this->gtpl = static::returnTpl();
        View::share('module_tpl', $this->tpl);
        View::share('module_gtpl', $this->gtpl);

    }

    public function getIndex(){

        $reviews = $this->review->orderBy('published_at', 'DESC')->get();
        return View::make($this->tpl.'index', array('reviews' => $reviews, 'locales' => $this->locales));
    }

    public function getCreate(){

        $this->moduleActionPermission('reviews','create');
        return View::make($this->tpl.'create', array('locales' => $this->locales));
    }

    public function postStore(){

        $this->moduleActionPermission('reviews','create');
        $json_request = array('status'=>FALSE,'responseText'=>'','responseErrorText'=>'','redirect'=>FALSE);
        if(Request::ajax()):
            $validator = Validator::make(Input::all(), Reviews::$rules);
            if($validator->passes()):
                self::saveReviewModel();
                $json_request['responseText'] = 'Отзыв создан';
                $json_request['redirect'] = link::auth('reviews');
                $json_request['status'] = TRUE;
            else:
                $json_request['responseText'] = 'Неверно заполнены поля';
                $json_request['responseErrorText'] = $validator->messages()->all();
            endif;
        else:
            return App::abort(404);
        endif;
        return Response::json($json_request,200);
    }

    public function getEdit($id){

        $this->moduleActionPermission('news','edit');
        $news = $this->news->find($id);
        if(is_null($news))
            return App::abort(404);
        #print_r($page);

        $metas = $this->news_meta->where('news_id', $news->id)->get();
        if(is_null($metas))
            return App::abort(404);

        foreach ($metas as $m => $meta) {
            $news_meta[$meta->language] = $meta;
        }
        #print_r($news_meta);

        $gall = Rel_mod_gallery::where('module', 'news')->where('unit_id', $id)->first();
        #print_r($gall->photos);

        return View::make($this->tpl.'edit', array('news'=>$news, 'news_meta'=>@$news_meta, 'locales' => $this->locales, 'gall' => $gall));
    }

    public function postUpdate($id){

        $this->moduleActionPermission('news','edit');
        $json_request = array('status'=>FALSE,'responseText'=>'','responseErrorText'=>'','redirect'=>FALSE);
        if(Request::ajax()):
            $validator = Validator::make(Input::all(), I18nNews::$rules);
            if($validator->passes()):

                #$json_request['responseText'] = "<pre>" . print_r($_POST, 1) . "</pre>";
                #return Response::json($json_request,200);

                $news = $this->news->find($id);
                self::saveNewsModel($news);
                $json_request['responseText'] = 'Новость сохранена';
                $json_request['redirect'] = link::auth('news');
                $json_request['status'] = TRUE;
            else:
                $json_request['responseText'] = 'Неверно заполнены поля';
                $json_request['responseErrorText'] = $validator->messages()->all();
            endif;
        else:
            return App::abort(404);
        endif;
        return Response::json($json_request,200);
    }

    public function deleteDestroy($id){

        $this->moduleActionPermission('news', 'delete');
        $json_request = array('status'=>FALSE, 'responseText'=>'');
        if(Request::ajax()):
            ## Следующая строка почему-то не работает:
            #$b = $this->news_meta->where('news_id', $id)->delete;
            ## Ну да ладно, удалим все языковые версии вот так:
            $metas = $this->news_meta->where('news_id', $id)->get();
            foreach ($metas as $meta)
                @$meta->delete();
            ## Удаляем саму страницу
            $a = @$this->news->find($id)->delete();
            ## Возвращаем сообщение чт овсе ОК
            #if( $a && $b ):
            $json_request['responseText'] = 'Новость удалена';
            $json_request['status'] = TRUE;
        #endif;
        else:
            return App::abort(404);
        endif;
        return Response::json($json_request,200);
    }

    private function saveReviewModel($review = NULL){

        if(is_null($review)):
            $review = $this->review;
        endif;

        ## Собираем значения объекта
        if(Allow::enabled_module('templates')):
            $review->template = Input::get('template');
        else:
            $review->template = 'default';
        endif;
        $review->publication = 1;
        $review->published_at = date("Y-m-d", strtotime(Input::get('published_at')));
        $slug = Input::get('slug');

        $locale = Config::get('app.locale');

        $review->name = Input::get('name.'.$locale);
        $review->position = Input::get('position.'.$locale);
        $review->content = Input::get('content.'.$locale);
        $review->slug = $slug;
        ## Сохраняем в БД
        $review->save();
        $review->touch();


        ## Работа с загруженными изображениями
        $images = @Input::get('uploaded_images');
        $gallery_id = @Input::get('gallery_id');
        if (@count($images)) {
            GalleriesController::imagesToUnit($images, 'reviews', $review->id, $gallery_id);
        }

        return $review->id;
    }

}