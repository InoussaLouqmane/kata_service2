<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $description
 * @property string $videoLink
 * @property integer $isfavorite
 * @property string $created_at
 * @property string $updated_at
 */
class Resource extends Model
{
    const TABLE_NAME = "resources";
    const ID = 'id';
    const DESCRIPTION = 'description';
    const VIDEO_LINK = 'videoLink';
    const IS_FAVORITE  = 'isfavorite';
    /**
     * @var array
     */
    protected $fillable = [

        self::DESCRIPTION,
        self::VIDEO_LINK,
        self::IS_FAVORITE
];

    protected $casts=[
    ];

    /**
     * @return HasMany
     */
    public function resourceUsers()
    {
        return $this->hasMany('App\Models\ResourceUser');
    }
}
