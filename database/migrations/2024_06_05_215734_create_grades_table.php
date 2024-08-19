<?php

use App\Models\Grade;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Grade::TABLENAME, function (Blueprint $table) {
            $table->bigIncrements(Grade::ID);
            $table->string(Grade::BELTNAME);
            $table->string(Grade::BELTCOLOR);
            $table->integer(Grade::NUMBER_OF_RED_BAR)->default(0)->nullable();
            $table->integer(Grade::NUMBER_OF_WHITE_BAR)->default(0)->nullable();
            $table->integer(Grade::NUMBER_OF_YELLOW_BAR)->default(0)->nullable();
            $table->string(Grade::BELT_PICTURE_PATH)->nullable();
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
        Schema::dropIfExists('grades');
    }
}
