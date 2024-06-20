<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $Student_id
 * @property integer $InitiatingSensei_id
 * @property integer $ApprovingSensei_id
 * @property string $transferStatus
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property User $ApprovingSensei
 * @property User $InitiatingSensei
 * @property User Student
 */
class Transfer extends Model
{
    const APPROVING_SENSEI_ID = 'ApprovingSensei_id';
    const INITIATING_SENSEI_ID = 'InitiatingSensei_id';
    const TRANSFER_STATUS = 'transferStatus';
    const COMMENT = 'comment';
    const STUDENT_ID = 'student_id';
    const TABLE_NAME = 'transfers';
    /**
     * @var array
     */
    protected $fillable = [
        self::APPROVING_SENSEI_ID,
        self::INITIATING_SENSEI_ID,
        self::TRANSFER_STATUS,
        self::COMMENT,
        self::STUDENT_ID,
    ];

    /**
     * @return BelongsTo
     */
    public function ApprovingSensei()
    {
        return $this->belongsTo('App\Models\User', 'ApprovingSensei_id');
    }

    /**
     * @return BelongsTo
     */
    public function InitiatingSensei()
    {
        return $this->belongsTo('App\Models\User', 'InitiatingSensei_id');
    }

    /**
     * @return BelongsTo
     */
    public function Student()
    {
        return $this->belongsTo('App\Models\User', 'Student_id');
    }
}
