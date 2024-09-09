<?php

use App\Models\Club;
use App\Models\Fees;
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
        Schema::create(Fees::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements(Fees::ID);
            $table->string(Fees::NAME);
            $table->float(Fees::COST, 8, 2)->default(0);
            $table->integer(Fees::FREQUENCY)->default(0);
            $table->unsignedBigInteger(Fees::CLUB_ID)->index();
            $table->foreign(Fees::CLUB_ID)->references(Club::ID)->on(Club::TABLE_NAME)->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp(Fees::LAST_CHARGED_AT)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Fees::TABLE_NAME);
    }
};
