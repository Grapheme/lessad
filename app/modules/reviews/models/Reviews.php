<?php

class Reviews extends BaseModel {

    protected $guarded = array();

    protected $table = 'reviews';

    public static $order_by = "reviews.published_at DESC,reviews.id DESC";

    public static $rules = array(
        'slug' => 'required',
        'name' => 'required'
    );

    public function photo() {

        return $this->hasOne('Photo','id','image_id');
    }

    public  function images(){
        return $this->belongsTo('Photo','image_id');
    }

    public  function meta(){
        return $this->hasMany('ReviewsMeta','review_id');
    }
}