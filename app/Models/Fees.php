<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;

    const TABLE_NAME = 'fees';
    const ID = 'id';
    const CLUB_ID = 'club_id';
    const NAME = 'name';
    const COST = 'cost';
    const FREQUENCY = 'frequency';
    const LAST_CHARGED_AT = 'last_charged_at';

    protected $primaryKey = self::ID;
    protected $fillable = [
        self::CLUB_ID,
        self::NAME,
        self::COST,
        self::FREQUENCY,
        self::LAST_CHARGED_AT,
    ];
    public function club(){
        return $this->belongsTo(Club::class);
    }

}
