<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
* @property integer $id
* @property string $name
* @property string $status
* @property string $created_at
* @property string $updated_at
 */
class Discipline extends Model
{
    use HasFactory;

    protected $table='disciplines';
    const TABLE_NAME = 'disciplines';
    const DESCRIPTION = 'description';
    const ID = 'id';
    const NAME = 'name';
    const STATUS = 'status';


    protected $fillable = [
      self::NAME,
      self::STATUS,
        self::DESCRIPTION,
    ];

    public function dojos()
    {
        return $this->hasMany(Dojo::class, 'martialArtType', 'id');
    }

    public function clubs(): HasMany
    {
        return $this->hasMany(Club::class, 'martialArtType', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, Grade::DISCIPLINE_ID, self::ID);
    }
}
