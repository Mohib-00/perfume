<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionDetailTable extends Migration
{
    public function up()
    {
        Schema::create('section_detail', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();   
            $table->string('heading');            
            $table->text('paragraph');           
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('section_detail');
    }
}
