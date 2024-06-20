<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $exam_id
 * @property integer $user_id
 * @property Exam $exam
 * @property User $user
 */
class Jury_Members extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'juryMembers';
    const EXAM_ID = "exam_id";
    const USER_ID = "user_id";

    /**
     * @var array
     */
    protected $fillable = [
        self::EXAM_ID,
        self::USER_ID
    ];

    /**
     * @return BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, null, 'event_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
