<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $grade_id
 * @property integer $user_id
 * @property Grade $grade
 * @property User $user
 */
class Grade_User extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'grade_user';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
