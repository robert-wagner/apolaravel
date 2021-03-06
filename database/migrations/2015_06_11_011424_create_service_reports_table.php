<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceReportsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reports', function (Blueprint $table) {
            $table->increments('id');

            $table->char('creator_id', 10);
            $table->char('event_name');
            $table->longText('description');
            $table->date('event_date');
            $table->enum('service_type', ['chapter', 'country', 'community', 'campus']);
            $table->string('location');
            $table->enum('project_type', ['inside', 'outside']);
            $table->boolean('off_campus');
            $table->integer('travel_time');
            $table->boolean('approved')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service_reports');
    }

}
