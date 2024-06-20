<?php

namespace App\Models;

use App\Enums\DeliberationStatus;
use App\Enums\ExamStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $exam_id
 * @property integer $student_id
 * @property float $noteKata
 * @property float $noteKihon
 * @property float $noteKumite
 * @property string $deliberation
 * @property Exam $exam
 * @property User $user
 */
class Exam_results extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'examResults';
    const EXAM_ID = 'exam_id';
    const STUDENT_ID = 'student_id';
    const NOTE_KATA = 'noteKata';
    const NOTE_KIHON = 'noteKihon';
    const NOTE_KUMITE = 'noteKumite';
    const DELIBERATION = 'deliberation';

    /**
     * @var array
     */
    protected $fillable = [
        self::EXAM_ID,
        self::STUDENT_ID,
        self::NOTE_KATA,
        self::NOTE_KIHON,
        self::NOTE_KUMITE,
        self::DELIBERATION
    ];
    protected $casts=[

      self::DELIBERATION => DeliberationStatus::class
    ];

    /**
     * @return BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, self::EXAM_ID, Exam::EVENT_ID);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, self::STUDENT_ID);
    }
}
