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
        Schema::create('sv_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',255)->unique();
            $table->stirng('password',128);
            $table->integer('id_entity');
            $table->boolean('active')->defaut(true);
            $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
            $table->timestamp('updated_at')->nullable()->default('0 ON UPDATE CURRENT_TIMESTAMP');
            $table->boolean('deleted')->default(false);
            $table->index('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sv_user');
    }
}
