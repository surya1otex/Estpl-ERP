<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('assignment_id')->index();
            $table->bigInteger('item_id');
            $table->string('model');
            $table->string('serial_number');
            $table->dateTime('war_issued_at', $precision = 0);
            $table->dateTime('war_expires_at', $precision = 0);
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
        Schema::dropIfExists('assignment_details');
    }
}
