<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(User::TABLE_NAME, function (Blueprint $table) {

            $table->bigIncrements(User::ID);
            $table->integer(User::FIRST_ATTEMPT)->default(1);
            $table->string(User::STATUS);
            $table->string(User::FIRST_NAME);
            $table->string(User::LAST_NAME);
            $table->string(User::EMAIL)->unique();
            $table->string(User::PHONE)->nullable();
            $table->timestamp(User::EMAIL_VERIFIED_AT)->nullable();
            $table->string(User::PHOTO_PATH)->nullable();
            $table->string(User::BIO_DESCRIPTION)->nullable();
            $table->string(User::MARTIAL_ART_TYPE);
            $table->string(User::GENRE);
            $table->string(User::PASSWORD);
            $table->string(User::ROLE);
            $table->string(User::LICENSE_ID)->nullable();
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(User::TABLE_NAME);
    }
};
