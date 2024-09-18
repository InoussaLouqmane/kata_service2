<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\TransactionStatus;
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

    const TABLE_NAME = 'payments';
    const ID = 'id';

    const FEE_ID = 'fee_id';
    const EVENT_ID = 'event_id';

    const PAYMENT_STATUS = 'payment_status';


    /**
     * @var array
     */

    protected $fillable = [

        self::PAYMENT_STATUS,
        self::FEE_ID,
        self::EVENT_ID

    ];
    protected $primaryKey = self::ID;


    protected $table = self::TABLE_NAME;


    /**
     * @return BelongsTo
     */



    public function fee(){
        return $this->belongsTo(Fees::class, self::FEE_ID);
    }
    /**
     * @return BelongsTo
     */
    public function transactions(){
        return $this->hasMany(Transaction::class, Transaction::PAYMENT_ID, self::ID);
    }

    public function event(){
        return $this->belongsTo(Event::class, self::EVENT_ID);
    }


}
