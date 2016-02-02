<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MercadolibreNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Notifications
        Schema::create('mercadolibre_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resource');
            $table->string('type');
            $table->string('resource_id');
            $table->string('user_id');
            $table->string('application_id');
            $table->smallInteger('attempts');
            $table->smallInteger('status');
            $table->dateTime('sent');
            $table->dateTime('received');
        });
        //Queue
        Schema::create('mercadolibre_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('status');
            $table->smallInteger('attempts');
            $table->string('type');
            $table->longText('data');
            $table->longText('message');
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
        Schema::table('mercadolibre_notifications', function (Blueprint $table) {
            //
        });
    }
}
