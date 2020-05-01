<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestigatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigators', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned()->index();
            $table->string('investigator_first_name',30);
            $table->string('investigator_last_name',30);
            $table->integer('regNum');
            $table->date('assign_date');
            $table->string('contact_no',12);
            $table->integer('corpse_id')->unsigned()->index();
            $table->integer('rank_id')->unsigned()->index();
            $table->integer('station_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('modified_by');
            $table->softDeletes();
            $table->timestamps();
            // $table->foreign('rank_id')->references('id')->on('ranks');
            // $table->foreign('station_id')->references('id')->on('stations');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('corpse_id')->references('id')->on('corpses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investigators');
    }
}
