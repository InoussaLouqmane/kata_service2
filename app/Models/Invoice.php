<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $event_id
 * @property integer $user_id
 * @property integer $amount
 * @property string $created_at
 * @property string $updated_at
 */
class Invoice extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['event_id', 'user_id', 'amount'];
    protected $casts = [
        'amount' => 'float',
    ];
}
