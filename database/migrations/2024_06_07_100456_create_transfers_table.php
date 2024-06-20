<?php

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Transfer::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger(Transfer::STUDENT_ID)->index();
            $table->foreign(Transfer::STUDENT_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade');
            $table->unsignedBigInteger(Transfer::INITIATING_SENSEI_ID)->index();
            $table->foreign(Transfer::INITIATING_SENSEI_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade');
            $table->unsignedBigInteger(Transfer::APPROVING_SENSEI_ID)->nullable()->index();
            $table->foreign(Transfer::APPROVING_SENSEI_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade');
            $table->primary([Transfer::STUDENT_ID, Transfer::INITIATING_SENSEI_ID]);
            $table->string(Transfer::TRANSFER_STATUS);
            $table->string(Transfer::COMMENT)->nullable();
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
        Schema::dropIfExists(Transfer::TABLE_NAME);
    }
}
