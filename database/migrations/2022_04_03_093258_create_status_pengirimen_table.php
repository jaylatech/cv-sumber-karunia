<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPengirimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengiriman_id')->unsigned()->nullable();
            $table->string('status');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('pengiriman_id')->references('id')->on('pengiriman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_pengiriman');
    }
}
