<?php

use App\Enums\DojoStatus;
use App\Models\Discipline;
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
        Schema::create(Discipline::TABLE_NAME, function (Blueprint $table) {

            $table->id();
            $table->string(Discipline::NAME)->unique();
            $table->string(Discipline::DESCRIPTION)->nullable();
            $table->string(Discipline::STATUS)->default(DojoStatus::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(DISCIPLINE::TABLE_NAME);
    }
};
