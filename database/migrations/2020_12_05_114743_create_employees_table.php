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
            $table->string('image');
            $table->date("birth_date")->nullable();
            $table->string('qualifications')->nullable();
            $table->string('home_address')->nullable();
            $table->string('jmbg')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('telephone_number')->nullable();
            $table->integer('office_number')->nullable();
            $table->text('additional_info_contact')->nullable();
            $table->unsignedBigInteger('pid')->nullable();
            $table->foreign('pid')->references('id')->on('employees')->onDelete('set null');

            //$table->foreign('sector_id')->references('id')->on('sectors')->onDelete('set null');

            /*$table->foreignId('sector_id')->constrained('sectors');*/
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
