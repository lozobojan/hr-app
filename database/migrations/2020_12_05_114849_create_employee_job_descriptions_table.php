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
            $table->string('sector');
            $table->string('job_description');
            $table->string('skills');

            $table->foreignId('employee_id')->constrained('employees');

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
