<?php

namespace App\Models;

use App\Enums\EventType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property integer $cost
 * @property string $startDate
 * @property string $endDate
 * @property string $address
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Exam $exam
 * @property Payment[] $payments
 */
class Event extends Model
{
    const TABLE_NAME = "events";
    const ID = "id";
    const USER_ID = 'user_id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const COST = 'cost';
    const START_DATE = 'startDate';
    const END_DATE = 'endDate';
    const ADDRESS = 'address';
    const TYPE = 'type';

    /**
     * @var array
     */
    protected $fillable = [
        self::USER_ID,
        self::TITLE,
        self::DESCRIPTION,
        self::COST,
        self::START_DATE,
        self::END_DATE,
        self::ADDRESS,
        self::TYPE,
    ];
    /**
     * @var array
     */

    protected $casts=[

        Self::TYPE=>EventType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exam()
    {
        return $this->hasOne('App\Models\Exam', 'event_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
