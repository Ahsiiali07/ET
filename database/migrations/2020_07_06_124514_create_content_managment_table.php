<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentManagmentTable extends Migration
{
        /**
     * Run the migrations.
     *
     * @return void
     */
        public function up() {
            Schema::create( 'content_management', static function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name' )->unique();
            $table->string( 'slug' )->unique();
            $table->text( 'content' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'content_management' );
    }
}

