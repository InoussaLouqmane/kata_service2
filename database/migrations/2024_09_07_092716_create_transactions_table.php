<?php

use App\Enums\TransactionStatus;
use App\Models\Payment;
use App\Models\Transaction;
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
        Schema::create(Transaction::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements(Transaction::ID);

            $table->foreign(Transaction::PAYER_ID)->references(User::ID)->on(User::TABLE_NAME);
            $table->foreign(Transaction::PAYMENT_ID)->references(Payment::ID)->on(Payment::TABLE_NAME);

            $table->unsignedBigInteger(Transaction::PAYER_ID) ;
            $table->unsignedBigInteger(Transaction::PAYMENT_ID);

            $table->string(Transaction::TRANSACTION_STATUS)->default(TransactionStatus::UNPAID);
            $table->string(Transaction::REFERENCE)->nullable();
            $table->float(Transaction::COST)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
