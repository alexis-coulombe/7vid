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

    public function getId()
    {
        return $this->id;
    }

    public function getCountryName()
    {
        return $this->country_name;
    }

    public function getCountryCode()
    {
        return $this->country_code;
    }

    public function getCode()
    {
        return $this->code;
    }
}
