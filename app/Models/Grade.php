<?php

namespace App\Models;

use App\Enums\GradColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property integer $id
 * @property string $beltColor
 * @property integer $numberOfRedBar
 * @property integer $numberOfWhiteBar
 * @property integer $numberOfYellowBar
 * @property string $beltPicturePath
 * @property string $created_at
 * @property string $updated_at
 * @property User[] $users
 */
class Grade extends Model
{
    /**
     * @var array
     */
    const TABLENAME = "grades";
    const BELTCOLOR = 'beltColor';
    const ID = "id";
    const BELTNAME = 'beltName';
    const BELT_PICTURE_PATH = 'beltPicturePath';
    const DISCIPLINE_ID = 'disciplineId';


    protected $fillable = [
        self::BELTNAME,
        self::BELTCOLOR,
        self::DISCIPLINE_ID,
        self::BELT_PICTURE_PATH,
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'grade_user', 'grade_id', 'user_id');
    }


    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class, 'exam_grade', 'grade_id', 'exam_id');
    }

    public function discipline(): BelongsTo{
        return $this->belongsTo(Discipline::class);
    }
}
