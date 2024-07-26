<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $club_id
 * @property string $name
 * @property string $address
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property Club $club
 */
class Dojo extends Model
{
    const ID = "id";
    const TABLE_NAME = "dojos";
    const CLUB_ID = 'club_id';
    const NAME = 'name';
    const MARTIAL_ART_TYPE ="martialArtType";
    const ADDRESS = 'address';
    const STATUS = 'status';
    const LONGITUDE='longitude';
    const LATITUDE = 'latitude';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        self::LATITUDE,
        self::LONGITUDE,
        self::MARTIAL_ART_TYPE,
        self::CLUB_ID,
        self::NAME,
        self::ADDRESS,
        self::STATUS
    ];

    /**
     * @return BelongsTo
     */
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}
