<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDeviceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sv_device_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',16);
        });
        DB::table('sv_device_type')->insert([
            'Mobile Android'
        ]);
        DB::table('sv_device_type')->insert([
            'Mobile Ios'
        ]);
        DB::table('sv_device_type')->insert([
            'Mobile Windows Phone'
        ]);
        DB::table('sv_device_type')->insert([
            'Computer'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sv_device_type');
    }
}
