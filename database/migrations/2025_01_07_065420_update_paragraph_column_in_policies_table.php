<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->longText('paragraph')->nullable()->change();  
        });
    }

    public function down()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->string('paragraph', 255)->nullable(false)->change(); 
        });
    }

};
