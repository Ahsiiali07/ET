<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'users', static function ( Blueprint $table ) {
            $table->id();
            $table->string( 'email' )->nullable()->unique();
            $table->string( 'name' )->nullable();
            $table->string( 'firstname' )->nullable();
            $table->string( 'lastname' )->nullable();
            $table->string( 'mobile' )->nullable();
            $table->string( 'address' )->nullable();
            $table->string( 'image' )->nullable();
            $table->string( 'description')->nullable();
            $table->string( 'date_of_birth' )->nullable();
            $table->string( 'gender' )->nullable();
            $table->string( 'social_token' )->nullable();
            $table->tinyInteger( 'user_type' )->nullable();
            $table->string( 'password' )->nullable();
            $table->boolean( 'status' )->default(true)->comment("admin approval flag");
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'users' );
    }
}
