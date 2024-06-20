<?php

use App\Models\Exam;
use App\Models\Jury_Members;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatejuryMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Jury_Members::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger(Jury_Members::EXAM_ID)->index();
            $table->foreign(Jury_Members::EXAM_ID)->references(Exam::EVENT_ID)->on(Exam::TABLE_NAME)->onDelete('cascade');
            $table->unsignedBigInteger(Jury_Members::USER_ID)->index();
            $table->foreign(Jury_Members::USER_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade');
            $table->primary([Jury_Members::EXAM_ID, Jury_Members::USER_ID]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Jury_Members::TABLE_NAME);
    }
}
