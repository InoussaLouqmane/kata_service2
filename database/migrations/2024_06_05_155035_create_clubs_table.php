<?php

use App\Models\Club;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Club::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements(Club::ID);
            $table->string(Club::REGISTERED_BY)->nullable();
            $table->string(Club::NAME);
            $table->unsignedBigInteger(Club::MARTIAL_ART_TYPE);
            $table->string(Club::IFU_NUMBER)->nullable();
            $table->string(Club::ADDRESS)->nullable();
            $table->string(Club::EMAIL)->unique()->nullable();
            $table->string(Club::WEBSITE_URL)->nullable();
            $table->text(Club::DESCRIPTION)->nullable();
            $table->string(Club::LOGO_PATH)->nullable();
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
        Schema::dropIfExists(Club::TABLE_NAME);
    }
}
