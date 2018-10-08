<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sv_device', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip',16);
            $table->string('description',100);
            $table->boolean('enabled')->default(true);
            $table->string('so_version',100);
            $table->integer('id_device_type');
            $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
            $table->timestamp('updated_at')->nullable()->default('0 ON UPDATE CURRENT_TIMESTAMP');
            $table->boolean('deleted')->default(false);
            $table->index('enabled');
            $table->foreign('id_device_type')->references('id')->on('device_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sv_device');
    }
}
