<?php

use App\Models\Event;
use App\Models\Exam;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Exam::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger(Exam::EVENT_ID);
            $table->foreign(Exam::EVENT_ID)->references(Event::ID)->on(Event::TABLE_NAME);
            $table->string(Exam::EXAM_STATUS);
            $table->timestamps();
            $table->primary(Exam::EVENT_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Exam::TABLE_NAME);
    }
}
