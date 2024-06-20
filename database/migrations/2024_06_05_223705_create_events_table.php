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
            $table->unsignedBigInteger(Event::ID);
            $table->primary(Event::ID);
            $table->string(Event::TITLE);
            $table->text(Event::DESCRIPTION)->nullable();
            $table->integer(Event::COST);
            $table->date(Event::START_DATE);
            $table->date(Event::END_DATE);
            $table->string(Event::ADDRESS);
            $table->string(Event::TYPE);
            $table->unsignedBigInteger(Event::USER_ID);
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
