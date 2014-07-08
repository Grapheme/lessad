<?php

class Reviews extends BaseModel {

    protected $guarded = array();

    protected $table = 'reviews';

    public static $order_by = "reviews.published_at DESC,reviews.id DESC";

    public static $rules = array(
        'name' => 'required'
    );
}