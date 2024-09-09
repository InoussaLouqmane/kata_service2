<?php


use App\Models\Exam;
use App\Models\Grade;
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
        Schema::create('exam_grade', function (Blueprint $table) {

            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references(Exam::EVENT_ID)->on(Exam::TABLE_NAME)->onDelete('cascade');
            $table->unsignedBigInteger('grade_id');
            $table->foreign('grade_id')->references(Grade::ID)->on(Grade::TABLENAME)->onDelete('cascade');
            $table->float('cost')->default(0);
            $table->primary(['exam_id', 'grade_id']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_grade');
    }
};


