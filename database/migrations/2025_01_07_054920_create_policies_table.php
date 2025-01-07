<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('main_heading')->nullable();  
            $table->string('sub_heading')->nullable(); 
            $table->string('paragraph')->nullable();  
            $table->boolean('show_terms')->default(0);
            $table->boolean('show_refund')->default(0);
            $table->boolean('show_shipping')->default(0);
            $table->boolean('show_privacy')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
