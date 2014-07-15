<?php

class SphinxsearchController extends \BaseController {

    public static $name = 'sphinxsearch';
    public static $group = 'production';

    public function __construct(){

        $this->module = array(
            'name' => self::$name,
            'group' => self::$group,
            'rest' => self::$group . "/" . self::$name,
            'tpl'  => static::returnTpl(),
            'gtpl' => static::returnTpl(),
        );
        View::share('module', $this->module);
    }

    public static function returnRoutes($prefix = null) {

        $class = __CLASS__;
        Route::post('search/request',$class.'@headerSearch');
        Route::post('search/request/{text}',$class.'@headerSearch');
    }

    public static function returnExtFormElements() {

        return null;
    }

    public static function returnActions() {

        return null;
    }

    public static function returnInfo() {

        return null;
    }

    public function headerSearch($text = null){

        if(is_null($text)):
            $text = Input::get('search_request');
        endif;

        if(!empty($text)):
            return Redirect::to('/search?query='.$text);
        else:
            return Redirect::back();
        endif;
    }
}