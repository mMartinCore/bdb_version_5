<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorpsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corpses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cr_no',50);
            $table->string('unidentified')->nullable();
            $table->string('corpse_image')->nullable();
            $table->string('first_name')->nullable()->default("Unidentified");
            $table->string('last_name',30)->nullable()->default("Unidentified");
            $table->string('middle_name',30)->nullable();
            $table->string('suspected_name',30)->nullable();



            $table->date('dob')->nullable();
            $table->string('sex');

            $table->string('nationality', 90)->default("Jamaica");
            $table->date('death_date')->nullable();

            $table->mediumText('address')->nullable();
            $table->string('parish')->nullable()->default("Not Certain");
            $table->unsignedInteger('station_id')->index(); //id
            $table->unsignedInteger('division_id')->index();
            $table->date('pickup_date');
            $table->string('dna',30)->nullable();
            $table->date('dna_date')->nullable();
            $table->string('pickup_location',200);
            $table->string('type_death')->nullable();
            $table->unsignedInteger('manner_id')->index();
            $table->unsignedInteger('anatomy_id')->index();
            $table->unsignedInteger('condition_id')->index(); 
            ////////////////////////////////////////////////
            $table->string('dr_name',50)->nullable();
            $table->string('dr_contact',20)->nullable();

            //////////////////////////////////////////////////
            $table->string('next_of_kin',50)->nullable();
            $table->string('next_of_kin_contact',20)->nullable();
            $table->string('next_of_kin_email',50)->nullable();
                   //////////////////////////////////////////////////
            $table->string('finger_print')->nullable();
            $table->date('finger_print_date')->nullable();
            $table->string('gazetted')->nullable();
            $table->string('volume_no',30)->nullable();
            $table->date('gazetted_date')->nullable();
            $table->string('pauper_burial_requested')->nullable()->default("No");
            $table->date('pauper_burial_requested_date')->nullable();
            $table->string('pauper_burial_approved')->nullable()->default("No-Request");
            $table->date('pauper_burial_approved_date')->nullable();
            $table->string('buried',20)->nullable();
            $table->date('burial_date')->nullable();
            /////////////////////////////////////

            // MORGUE INFO
            $table->string('postmortem_status',50); // id
            $table->date('postmortem_date')->nullable();
            $table->unsignedInteger('funeralhome_id')->index(); //id
            $table->string('pathlogist', 100); //id
            $table->mediumText('cause_of_Death')->nullable();
            $table->string('body_status',50)->nullable()->default("No Status"); // id
            $table->integer('user_id');
            $table->integer('modified_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
           // $table->foreign('user_id')->references('id')->on('users');
           // $table->foreign('funeralhome_id')->references('id')->on('funeralhomes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corpses');
    }
}
