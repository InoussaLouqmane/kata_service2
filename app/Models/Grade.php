<?php

namespace App\Models;

use App\Enums\GradColor;
use Illuminate\Database\Eloquent\Model;
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
    const NUMBER_OF_RED_BAR = 'numberOfRedBar';
    const NUMBER_OF_WHITE_BAR = 'numberOfWhiteBar';
    const NUMBER_OF_YELLOW_BAR = 'numberOfYellowBar';
    const BELT_PICTURE_PATH = 'beltPicturePath';


    protected $fillable = [
        self::BELTNAME,
      self::BELTCOLOR,
      self::NUMBER_OF_RED_BAR,
      self::NUMBER_OF_WHITE_BAR,
      self::NUMBER_OF_YELLOW_BAR,
      self::BELT_PICTURE_PATH,
    ];




    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class, 'grade_user', 'grade_id', 'user_id');
    }
}
