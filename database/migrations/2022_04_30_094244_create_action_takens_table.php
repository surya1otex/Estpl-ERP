<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionTakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_takens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('assign_details_id')->index();
            $table->integer('status');
            $table->string('image')->nullable();
            $table->double('lat', 15, 8);
            $table->double('long', 15, 8);
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
        Schema::dropIfExists('action_takens');
    }
}
