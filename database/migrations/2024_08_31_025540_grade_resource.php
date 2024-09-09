<?php

use App\Models\Grade;
use App\Models\Resource;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_resource', function (Blueprint $table) {

            $table->unsignedBigInteger('grade_id')->index();
            $table->foreign('grade_id')->references(Grade::ID)->on(Grade::TABLENAME)->onDelete('cascade');
            $table->unsignedBigInteger('resource_id')->index();
            $table->foreign('resource_id')->references(Resource::ID)->on(Resource::TABLE_NAME)->onDelete('cascade');
            $table->primary(['grade_id', 'resource_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_resource');
    }
};
