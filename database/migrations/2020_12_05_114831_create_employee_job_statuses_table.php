<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeJobStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_job_statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status');
            $table->date('date_hired');
            /*$table->string('bank_name');*/
            /*$table->string('bank_number');*/
            $table->string('additional_info');
            $table->foreignId('type')->constrained('hire_types');
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
        Schema::dropIfExists('employee_job_statuses');
    }
}
