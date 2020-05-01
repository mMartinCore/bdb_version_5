<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDnasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dnas', function (Blueprint $table) {
            $table->increments('id'); 
            $table->text('dna')->nullable();
            $table->integer('corpse_id')->unsigned()->index();
            $table->date('dna_request_date')->nullable();   
            $table->date('dna_result_date')->nullable();   
            $table->mediumText('dna_result')->nullable(); 
            $table->softDeletes();
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
        Schema::dropIfExists('dnas');
    }
}
