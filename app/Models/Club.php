<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $RegisteredBy
 * @property string $name
 * @property string $ifuNumber
 * @property integer $martialArtType
 * @property string $email
 * @property string $websiteUrl
 * @property string $description
 * @property string $logoPath
 * @property string $created_at
 * @property string $updated_at
 * @property Dojo[] $dojos
 */
class Club extends Model

{
    use HasFactory;

    const ID = "id";
    const TABLE_NAME = "clubs";
    const REGISTERED_BY = 'RegisteredBy';
    const NAME = 'name';
    const IFU_NUMBER = 'ifuNumber';
    const MARTIAL_ART_TYPE = 'martialArtType';
    const EMAIL = 'email';
    const WEBSITE_URL = 'websiteUrl';
    const DESCRIPTION = 'description';
    const LOGO_PATH = 'logoPath';
    const ADDRESS = 'address';

    /**
     * @var array
     */
    protected $fillable = [

            self::ADDRESS,
            self::NAME,
            self::IFU_NUMBER,
            self::MARTIAL_ART_TYPE,
            self::EMAIL,
            self::WEBSITE_URL,
            self::DESCRIPTION,
            self::LOGO_PATH,
            self::REGISTERED_BY,

        ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'club_user', 'club_id', 'user_id');
    }

    public function dojos() : HasMany{
        return $this->hasMany(Dojo::class, 'club_id', 'id');
}
public function discipline(): BelongsTo
{
        return $this->belongsTo(Discipline::class, 'martialArtType', 'id' );
}
}
