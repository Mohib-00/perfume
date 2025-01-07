<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('email')->nullable(); 
            $table->string('number')->nullable(); 
            $table->string('youtube')->nullable();  
            $table->string('tiktok')->nullable(); 
            $table->string('instagram')->nullable();  
            $table->string('facebook')->nullable();  
            $table->string('twitter')->nullable();  
            $table->string('image')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['email', 'number', 'youtube', 'tiktok', 'instagram', 'facebook', 'twitter', 'image']);
        });
    }
}
