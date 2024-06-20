<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $event_id
 * @property integer $user_id
 * @property string $comment
 * @property string $paymentMethod
 * @property string $paymentStatus
 * @property Event $event
 * @property User $user
 */
class Payment extends Model

{

    const TABLE_NAME = "payments";
    const EVENT_ID='event_id';
    const USER_ID = 'user_id';
    const COMMENT = 'comment';
    const PAYMENT_METHOD = 'paymentMethod';
    const PAYMENT_STATUS = 'paymentStatus';


    /**
     * @var array
     */

    protected $fillable = [

        self::EVENT_ID,
        self::USER_ID,
        self::COMMENT,
        self::PAYMENT_METHOD,
        self::PAYMENT_STATUS

        ];
    protected $casts=[
        self::PAYMENT_STATUS=>PaymentStatus::class,
        self::PAYMENT_METHOD=>PaymentMethod::class
    ];


    /**
     * @return BelongsTo
     */
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }


    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
