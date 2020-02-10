<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Country extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code'
    ];

    /**
     * Get user relation
     *
     * @return BelongsTo
     */
    public function users(): ?BelongsTo
    {
        $this->belongsTo(User::class, 'id', 'country_id');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get country name
     *
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->country_name;
    }

    /**
     * Set country name
     *
     * @param $countryName
     */
    public function setCountryName(string $countryName): void
    {
        $this->country_name = $countryName;
    }

    /**
     * Get country code
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->country_code;
    }

    /**
     * Set country code
     *
     * @param $countryCode
     */
    public function setCountryCode(string $countryCode): void
    {
        $this->country_code = $countryCode;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
