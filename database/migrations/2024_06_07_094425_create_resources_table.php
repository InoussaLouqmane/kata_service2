<?php

use App\Models\Resource;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Resource::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements(Resource::ID);
            $table->text(Resource::DESCRIPTION)->nullable();
            $table->string(Resource::VIDEO_LINK);
            $table->integer(Resource::IS_FAVORITE)->default(0);
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
        Schema::dropIfExists(Resource::TABLE_NAME);
    }
}
