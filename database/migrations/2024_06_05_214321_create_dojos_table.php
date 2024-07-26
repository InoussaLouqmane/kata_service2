<?php

use App\Models\Club;
use App\Models\Dojo;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDojosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Dojo::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger(Dojo::ID);
            $table->unsignedBigInteger(Dojo::CLUB_ID);
            $table->string(Dojo::MARTIAL_ART_TYPE);
            $table->decimal(Dojo::LONGITUDE,10, 7)->nullable();
            $table->decimal(Dojo::LATITUDE, 10, 7)->nullable();
            $table->string(Dojo::NAME);
            $table->string(Dojo::ADDRESS);
            $table->string(Dojo::STATUS);
            $table->primary( Dojo::ID);
            $table->foreign(Dojo::CLUB_ID)->references(Club::ID)->on(Club::TABLE_NAME)->onDelete('cascade');
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
        Schema::dropIfExists(Dojo::TABLE_NAME);
    }
}
