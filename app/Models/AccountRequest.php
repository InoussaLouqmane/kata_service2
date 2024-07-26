<?php

namespace App\Models;

use App\Enums\Genre;
use App\Enums\MartialArtType;
use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $phone
 * @property string $genre
 * @property string $martialArtType
 * @property string $licenseId
 * @property integer $grade
 * @property string $clubName
 * @property string $status
 * @property string $comment
 * @property string $clubEmail
 * @property integer $user_id
 */
class AccountRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     *
     */
    const TABLE_NAME = 'accountRequests';
    const ROLE = 'role';
    protected $table = self::TABLE_NAME;
    const ID = 'id';
    const FIRST_NAME = 'firstName';
    const LAST_NAME = 'lastName';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const GENRE = 'genre';
    const MARTIAL_ART_TYPE = 'martialArtType';
    const LICENSE_ID = 'licenseId';
    const GRADE = 'grade';
    const CLUB_NAME = 'clubName';
    const STATUS = 'status';
    const COMMENT = 'comment';
    const CLUB_EMAIL = 'clubEmail';
    const CLUB_ADDRESS = 'clubAddress';
    const CLUB_WEBSITE_URL = 'ClubWebsiteUrl';
    const CLUB_PHOTO_PATH = 'clubLogoPath';
    const CLUB_DESCRIPTION = 'clubDescription';
    const CLUB_IFU_NUMBER = 'ClubIfuNumber';
    const USER_ID = 'user_id';
    const CLUB_ID = 'club_id';


    protected $casts=[

        self::MARTIAL_ART_TYPE =>MartialArtType::class,
        self::STATUS => RequestStatus::class,
        self::USER_ID => 'integer',
        self::GENRE =>Genre::class

    ];

    /**
     * @var array
     */
    protected $fillable = [

        self::CLUB_IFU_NUMBER,
        self::CLUB_DESCRIPTION,
        self::CLUB_PHOTO_PATH,
        self::CLUB_WEBSITE_URL,

        self::CLUB_ID,
        self::ROLE,
        self::FIRST_NAME,
        self::LAST_NAME,
        self::EMAIL,
        self::PHONE,
        self::GENRE,
        self::MARTIAL_ART_TYPE,
        self::LICENSE_ID,
        self::GRADE,
        self::CLUB_NAME,
        self::STATUS,
        self::COMMENT,
        self::CLUB_EMAIL,
        self::USER_ID,
        self::CLUB_ADDRESS
    ];
}
