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
    const ADDRESS = 'address';
    const STATUS = 'status';
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
        return $this->belongsTo('App\Models\Club');
    }
}
