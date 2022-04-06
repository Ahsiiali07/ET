<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContentManagementTableAddTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'content_management', static function ( Blueprint $table ) {
            $table->integer( 'type' )->nullable();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'content_management', static function ( Blueprint $table ) {
            $table->dropColumn( [ 'type' ] );
        } );
    }
}
