<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantTableReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_table_reservations', function (Blueprint $table) {
            $table->id();
            $table->date('reservation_date');
            $table->time('reservation_start_time');
            $table->time('reservation_end_time');
            $table->bigInteger('created_by')->unsigned();
            // $table->foreign('created_by')->references('id')->on('admin_users')->onDelete('SET NULL');
            //TODO activate foriegin keys
            $table->bigInteger('restaurant_table_id')->unsigned();
            // $table->foreign('restaurant_table_id')->references('id')->on('restaurant_tables')->onDelete('RESTRICT');
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
        Schema::dropIfExists('restaurant_table_reservations');
    }
}
