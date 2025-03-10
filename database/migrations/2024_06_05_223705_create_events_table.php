<?php

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Event::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements(Event::ID);


            $table->string(Event::UIID)->nullable();
            $table->string(Event::TITLE);
            $table->text(Event::DESCRIPTION)->nullable();
            $table->integer(Event::COST)->default(0);
            $table->timestamp(Event::START_DATE);
            $table->timestamp(Event::END_DATE);
            $table->string(Event::ADDRESS);
            $table->string(Event::TYPE)->nullable();
            $table->unsignedBigInteger(Event::USER_ID)->nullable();
            $table->foreign(Event::USER_ID)
                ->references(User::ID)
                ->on(User::TABLE_NAME)
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists(Event::TABLE_NAME);
    }
}
