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

    public static function readIndexes()
    {

        $result['channels'] = SphinxSearch::search(Input::get('query'), 'channelsIndex')->setFieldWeights(array('title' => 10, 'short' => 8, 'desc' => 6, 'category_title' => 1))
            ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
            ->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "@weight DESC")
            ->limit(6)->get();

        $result['products'] = SphinxSearch::search(Input::get('query'), 'productsIndex')->setFieldWeights(array('title' => 10, 'short' => 8, 'desc' => 6, 'category_title' => 1))
            ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
            ->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "@weight DESC")
            ->limit(6)->get();

        $result['reviews'] = SphinxSearch::search(Input::get('query'), 'reviewsIndex')->setFieldWeights(array('name' => 10, 'name' => 8, 'details' => 1))
            ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
            ->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "@weight DESC")
            ->limit(6)->get();

        $result['pages'] = SphinxSearch::search(Input::get('query'), 'pagesIndex')->setFieldWeights(array('seo_title' => 10, 'seo_description' => 10, 'seo_h1' => 10, 'content' => 8))
            ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
            ->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "@weight DESC")
            ->limit(6)->get();
        $pagesIDs = self::getValueInObject($result['pages']);
        print_r($pagesIDs);exit;
//            $result['pages'] = $result['pages']->with('metas')->get();
        return $result;
    }
}