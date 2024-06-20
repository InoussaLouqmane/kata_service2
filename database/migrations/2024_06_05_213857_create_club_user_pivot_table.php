<?php

use App\Models\Club;
use App\Models\Club_User;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClubUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Club_User::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger(Club_User::CLUB_ID)->index();
            $table->foreign(Club_User::CLUB_ID)->references(Club::ID)->on(Club::TABLE_NAME)->onDelete('cascade');
            $table->unsignedBigInteger(Club_User::USER_ID)->index();
            $table->foreign(Club_User::USER_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade');
            $table->primary([Club_User::CLUB_ID, Club_User::USER_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Club_User::TABLE_NAME);
    }
}
