<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const TABLE_NAME = 'transactions';
    const ID = 'id';
    const PAYER_ID = 'payer_id';
    const PAYMENT_ID = 'payment_id';
    const INVOICE_ID = 'invoice_id';
    const TRANSACTION_STATUS = 'transaction_status';
    const REFERENCE = 'reference';
    const COST = 'cost';

    protected $primaryKey = self::ID;

    protected $fillable = [
        self::INVOICE_ID,
        self::PAYMENT_ID,
        self::TRANSACTION_STATUS,
        self::PAYER_ID,
        self::REFERENCE,
        self::COST,

    ];

    public function payment(){
        return $this->belongsTo(Payment::class, self::PAYMENT_ID );
    }

    public function user(){
        return $this->belongsTo(User::class, self::PAYER_ID );
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class, self::INVOICE_ID );
    }





}
