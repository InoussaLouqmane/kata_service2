<?php

use App\Models\Event;
use App\Models\Fees;
use App\Models\Payment;
use App\Models\User;
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
        Schema::create(Payment::TABLE_NAME, function (Blueprint $table) {

            $table->bigIncrements(Payment::ID);

            $table->unsignedBigInteger(Payment::FEE_ID)->index();
            $table->unsignedBigInteger(Payment::EVENT_ID)->index()->nullable();


            $table->timestamps();

            $table->foreign(Payment::FEE_ID)->references(Fees::ID)->on(Fees::TABLE_NAME)->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(Payment::EVENT_ID)->references(Event::ID)->on(Event::TABLE_NAME)->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Payment::TABLE_NAME);
    }
};
