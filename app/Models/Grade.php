<?php

namespace App\Models;

use App\Enums\GradColor;
use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['beltColor', 'numberOfRedBar', 'numberOfWhiteBar', 'numberOfYellowBar', 'beltPicturePath'];
    protected $casts = [
        'numberOfRedBar' => 'integer',
        'beltPicturePath' => 'string',
        'numberOfWhiteBar' => 'integer',
        'beltColor' => GradColor::class,
        'numberOfYellowBar' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
