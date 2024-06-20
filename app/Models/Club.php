<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $RegisteredBy
 * @property string $name
 * @property string $ifuNumber
 * @property string $martialArtType
 * @property string $email
 * @property string $websiteUrl
 * @property string $description
 * @property string $logoPath
 * @property string $created_at
 * @property string $updated_at
 * @property Dojo[] $dojos
 */
class Club extends Model

{

    const ID = "id";
    const TABLE_NAME = "clubs";
    const REGISTERED_BY = 'RegisteredBy';
    const NAME = 'name';
    const IFU_NUMBER = 'ifuNumber';
    const MARTIAL_ART_TYPE = 'martialArtType';
    const EMAIL = 'email';
    const WEBSITE_URL = 'websiteUrl';
    const DESCRIPTION = 'description';
    const LOGO_PATH = 'logoPath';

    /**
     * @var array
     */
    protected $fillable = [

            self::NAME,
            self::IFU_NUMBER,
            self::MARTIAL_ART_TYPE,
            self::EMAIL,
            self::WEBSITE_URL,
            self::DESCRIPTION,
            self::LOGO_PATH,
            self::REGISTERED_BY,

        ];

    /**
     * @return HasMany
     */
    public function dojos()
    {
        return $this->hasMany('App\Models\Dojo');
    }
}
