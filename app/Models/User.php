<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Genre;
use App\Enums\MartialArtType;
use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    const TABLE_NAME = "users";
    const ID = 'id';
    const STATUS = 'status';
    const FIRST_NAME = 'firstName';
    const LAST_NAME = 'lastName';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const EMAIL_VERIFIED_AT = 'email_verified_at';
    const PHOTO_PATH = 'photoPath';
    const BIO_DESCRIPTION = 'bioDescription';
    const MARTIAL_ART_TYPE = 'martialArtType';
    const GENRE = 'genre';
    const PASSWORD = 'password';
    const ROLE = 'role';
    const LICENSE_ID = 'licenseId';

    protected $fillable = [

        self::ID,
        self::FIRST_NAME,
        self::LAST_NAME,
        self::EMAIL,
        self::PHONE,
        self::PASSWORD,
        self::STATUS,
        self::ROLE,
        self::LICENSE_ID,
        self::BIO_DESCRIPTION,
        self::MARTIAL_ART_TYPE,
        self::GENRE,
        self::PHOTO_PATH,
        self::EMAIL_VERIFIED_AT,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::PASSWORD,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::MARTIAL_ART_TYPE => MartialArtType::class,
        self::ROLE => Role::class,
        self::GENRE => Genre::class,
        self::PASSWORD=>'hashed'

    ];
}
