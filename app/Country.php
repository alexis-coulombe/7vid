<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Country extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code'
    ];

    public function getId() : int
    {
        return $this->id;
    }

    public function getCountryName() : string
    {
        return $this->country_name;
    }

    public function getCountryCode() : string
    {
        return $this->country_code;
    }

    public function getCode() : string
    {
        return $this->code;
    }
}
