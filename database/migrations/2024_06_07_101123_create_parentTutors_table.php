<?php

use App\Models\ParentTutor;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParentTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ParentTutor::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger(ParentTutor::STUDENT_ID)->index();
            $table->foreign(ParentTutor::STUDENT_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade');
            $table->unsignedBigInteger(ParentTutor::PARENT_ID)->index();
            $table->foreign(ParentTutor::PARENT_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade');
            $table->primary([ParentTutor::STUDENT_ID,ParentTutor::PARENT_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ParentTutor::TABLE_NAME);
    }
}
