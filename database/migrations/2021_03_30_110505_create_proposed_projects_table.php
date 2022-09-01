<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposedProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposed_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('project_type');
            $table->string('est_project_value');
            $table->string('scheme');
            $table->string('owner_depart');
            $table->string('circle');
            $table->string('divison');
            $table->string('sub_division');
            $table->string('district');
            $table->timestamp('approval_submission');
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
        Schema::dropIfExists('proposed_projects');
    }
}
