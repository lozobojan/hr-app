<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeJobDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_job_descriptions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('workplace');
            $table->string('job_description');
            $table->string('skills');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_job_descriptions');
    }
}
