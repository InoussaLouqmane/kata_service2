<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $Student_id
 * @property integer $Parent_id
 * @property User $Parent
 * @property User $Student
 */
class ParentTutor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'parentTutors';
    const STUDENT_ID = 'Student_id';
    const PARENT_ID = 'Parent_id';

    /**
     * @var array
     */
    protected $fillable = [
        self::PARENT_ID,
        self::STUDENT_ID
    ];

    /**
     * @return BelongsTo
     */
    public function Parent()
    {
        return $this->belongsTo(User::class, 'Parent_id');
    }

    /**
     * @return BelongsTo
     */
    public function Student()
    {
        return $this->belongsTo(User::class, 'Student_id');
    }
}
