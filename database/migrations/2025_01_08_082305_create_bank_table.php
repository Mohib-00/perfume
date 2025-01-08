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
        Schema::create('bank', function (Blueprint $table) {
            $table->id();
            $table->text('paragraph')->nullable(); 
            $table->string('name')->nullable(); 
            $table->string('title')->nullable();  
            $table->string('account_number')->nullable();  
            $table->string('iban')->nullable();  
            $table->string('branch_name')->nullable();  
            $table->timestamps();  
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank');
    }
};
