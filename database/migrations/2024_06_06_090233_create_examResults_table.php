<?php

use App\Models\Exam;
use App\Models\Exam_results;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Exam_results::TABLE_NAME, function (Blueprint $table) {

            $table->unsignedBigInteger(Exam_results::EXAM_ID)->index();
            $table->foreign(Exam_results::EXAM_ID)->references(Exam::EVENT_ID)->on(Exam::TABLE_NAME)->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger(Exam_results::STUDENT_ID)->index();
            $table->foreign(Exam_results::STUDENT_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade')->onUpdate('cascade');
            $table->primary([Exam_results::EXAM_ID, Exam_results::STUDENT_ID]);
            $table->unsignedBigInteger(Exam_results::GRADE_ID)->index();
            $table->foreign(Exam_results::GRADE_ID)->references(Grade::ID)->on(Grade::TABLENAME)->onDelete('cascade')->onUpdate('cascade');
            $table->float(Exam_results::NOTE_KATA)->default(0);
            $table->float(Exam_results::NOTE_KIHON)->default(0);
            $table->float(Exam_results::NOTE_KUMITE)->default(0);
            $table->string(Exam_results::CONVOCATION)->nullable();
            $table->string(Exam_results::DELIBERATION)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Exam_results::TABLE_NAME);
    }
}
