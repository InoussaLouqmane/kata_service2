<?php

use App\Models\Discipline;
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
            $table->unsignedBigInteger(Grade::DISCIPLINE_ID);
            $table->foreign(Grade::DISCIPLINE_ID)->references(Grade::ID)->on(Discipline::TABLE_NAME)->onDelete('cascade')->onUpdate('cascade');
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
