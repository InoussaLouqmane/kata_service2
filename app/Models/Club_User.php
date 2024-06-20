<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $club_id
 * @property integer $user_id
 * @property Club $club
 * @property User $user
 */
class Club_User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    const TABLE_NAME = "club_user";
    const CLUB_ID = "club_id";
    const USER_ID = "user_id";


    /**
     * @var array
     */
    protected $fillable = [
        self::CLUB_ID,
        self::USER_ID,
    ];

    /**
     * @return BelongsTo
     */
    public function club()
    {
        return $this->belongsTo('App\Models\Club');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
