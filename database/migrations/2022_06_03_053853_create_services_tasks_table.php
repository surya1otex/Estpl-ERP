<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('item_details_id')->index();
            $table->unsignedInteger('po_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->integer('status');
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
        Schema::dropIfExists('services_tasks');
    }
}
