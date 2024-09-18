<?php

namespace App\Models;

use App\Enums\EventType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property integer $cost
 * @property string $startDate
 * @property string $endDate
 * @property string $address
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Exam $exam
 * @property Payment[] $payments
 */
class Event extends Model
{
    const TABLE_NAME = "events";
    const ID = "id";
    const UIID = "uiid";
    const USER_ID = 'user_id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const COST = 'cost';
    const START_DATE = 'startDate';
    const END_DATE = 'endDate';
    const ADDRESS = 'address';
    const TYPE = 'type';


    /**
     * @var array
     */
    protected $fillable = [
        self::USER_ID,
        self::TITLE,
        self::DESCRIPTION,
        self::COST,
        self::START_DATE,
        self::END_DATE,
        self::ADDRESS,
        self::TYPE,
    ];
    /**
     * @var array
     */

    protected $casts=[

        Self::TYPE=>EventType::class,
        Self::START_DATE => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function exam()
    {
        return $this->hasOne('App\Models\Exam', 'event_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payment()
    {
       return $this->hasOne(Payment::class, 'event_id');
    }

    public function examResults(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'examResults', 'exam_id', 'student_id')
            ->withPivot('grade_id', 'noteKata', 'noteKihon', 'noteKumite', 'deliberation', 'convocation');
    }

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class, 'exam_grade', 'exam_id', 'grade_id')
            ->withPivot('cost');
    }

    public function getStartDate(){
        return $this->startDate->format('d M Y à (H:i)');
    }
    public function getStartTime(){
        return $this->startDate->format('H:i');
    }

    public function getLocation(){
        return $this->address;
    }


}
