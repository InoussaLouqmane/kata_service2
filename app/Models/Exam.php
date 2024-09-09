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

    protected $primaryKey = 'event_id';
    /**
     * @var array
     */
    protected $fillable = [
        self::EVENT_ID,
        self::EXAM_STATUS,
    ];


    /**
     * @return HasMany
     */
    /*public function examResults()
    {
        return $this->hasMany(Exam_results::class, Exam_results::EXAM_ID, self::EVENT_ID);
    }*/

    /**
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function examResults(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'examResults', 'exam_id', 'student_id')
            ->withPivot('grade_id');
    }

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class, 'exam_grade', 'exam_id', 'grade_id')
            ->withPivot('cost');
    }

}
