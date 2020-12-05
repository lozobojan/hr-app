<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('last_name');
            $table->string('image_path');
            $table->date("birth_date")->nullable();
            $table->string('qualifications')->nullable();
            $table->string('home_address')->nullable();
            $table->string('JMBG')->nullable();
            $table->text('additional_info')->nullable();

            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('telephone_number')->nullable();
            $table->integer('office_number')->nullable();
            $table->text('additional_info_contact')->nullable();

            // $table->foreignId('pid')->constrained('employees');

            $table->unsignedBigInteger('pid')->nullable();
            $table->foreign('pid')->references('id')->on('employees');
            // $table->integer('pid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
