<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('first_id')->nullable();
            $table->string('file_path1')->nullable();
            $table->string('file_path2')->nullable();
            $table->string('file_path3')->nullable();
            $table->float('length_optic')->nullable();
            $table->string('mobile_technology')->nullable();
            $table->string('object_type')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('second_forms');
    }
}
