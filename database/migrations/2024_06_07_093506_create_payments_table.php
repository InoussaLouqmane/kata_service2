<?php

use App\Models\Event;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Payment::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger(Payment::EVENT_ID)->index();
            $table->foreign(Payment::EVENT_ID)->references(Event::ID)->on(Event::TABLE_NAME)->onDelete('cascade');
            $table->unsignedBigInteger(Payment::USER_ID)->index();
            $table->foreign(Payment::USER_ID)->references(User::ID)->on(User::TABLE_NAME)->onDelete('cascade');
            $table->primary([Payment::EVENT_ID, Payment::USER_ID]);
            $table->string(Payment::COMMENT)->nullable();
            $table->string(Payment::PAYMENT_METHOD);
            $table->string(Payment::PAYMENT_STATUS);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Payment::TABLE_NAME);
    }
}
