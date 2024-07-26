<?php

use App\Models\AccountRequest;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AccountRequest::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements(AccountRequest::ID);
            $table->string(AccountRequest::FIRST_NAME);
            $table->string(AccountRequest::LAST_NAME);
            $table->string(AccountRequest::EMAIL);
            $table->string(AccountRequest::ROLE);
            $table->string(AccountRequest::PHONE)->nullable();
            $table->string(AccountRequest::GENRE)->nullable();
            $table->string(AccountRequest::MARTIAL_ART_TYPE);
            $table->string(AccountRequest::LICENSE_ID)->nullable();
            $table->string(AccountRequest::GRADE);
            $table->string(AccountRequest::CLUB_NAME);
            $table->string(AccountRequest::CLUB_ADDRESS);
            $table->string(AccountRequest::CLUB_EMAIL)->nullable();
            $table->string(AccountRequest::STATUS);
            $table->string(AccountRequest::COMMENT)->nullable();

            $table->string(AccountRequest::CLUB_WEBSITE_URL)->nullable();
            $table->string(AccountRequest::CLUB_PHOTO_PATH)->nullable();
            $table->string(AccountRequest::CLUB_DESCRIPTION)->nullable();
            $table->string(AccountRequest::CLUB_IFU_NUMBER)->nullable();

            $table->unsignedbiginteger(AccountRequest::CLUB_ID)->nullable();
            $table->unsignedbiginteger(AccountRequest::USER_ID)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(AccountRequest::TABLE_NAME);
    }
}
