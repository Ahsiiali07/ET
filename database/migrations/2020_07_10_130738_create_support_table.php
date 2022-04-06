<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support', static function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_sp');
            $table->string('description_en');
            $table->string('description_sp');
            $table->tinyInteger('status');
            $table->string('client_email');
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
        Schema::dropIfExists('support');
    }
}
