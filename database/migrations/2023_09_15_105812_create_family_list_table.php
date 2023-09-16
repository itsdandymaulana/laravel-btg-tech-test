<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_list', function (Blueprint $table) {
            $table->id('fl_id');
            $table->unsignedBigInteger('cst_id');
            $table->string('fl_relation', 50);
            $table->string('fl_name', 50);
            $table->date('fl_dob');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cst_id')->references('cst_id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_list');
    }
}
