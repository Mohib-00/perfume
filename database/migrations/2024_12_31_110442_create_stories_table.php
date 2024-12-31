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
    Schema::create('stories', function (Blueprint $table) {
        $table->id();
        $table->string('image')->nullable();
        $table->string('heading')->nullable();
        $table->text('paragraph')->nullable();
        $table->string('image_story')->nullable();
        $table->text('paragraph_story')->nullable();
        $table->string('heading_story')->nullable();
        $table->string('image_1')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
