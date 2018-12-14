<?php

namespace App;

use Webpatser\Uuid\Uuid;

trait Uuids{
    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->{$model->id} = Uuid::generate()->string;
        });
    }
}