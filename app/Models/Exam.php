<?php

namespace App\Models;

use App\Enums\ExamStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $event_id
 * @property string $examStatus
 * @property string $created_at
 * @property string $updated_at
 * @property ExamResult[] $examResults
 * @property Event $event
 * @property User[] $users
 */
class Exam extends Model
{
    const TABLE_NAME = 'exams';
    const EVENT_ID ="event_id";
    const EXAM_STATUS ="examStatus";

    /**
     * @var array
     */
    protected $fillable = [
        self::EVENT_ID,
        self::EXAM_STATUS
    ];
    protected $casts=[
        self::EXAM_STATUS=>ExamStatus::class
    ];

    /**
     * @return HasMany
     */
    public function examResults()
    {
        return $this->hasMany('App\Models\ExamResult', null, self::EVENT_ID);
    }

    /**
     * @return BelongsTo
     */
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'juryMembers');
    }
}
