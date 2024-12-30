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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();  
            $table->string('hover_image')->nullable(); 
            $table->string('name')->nullable();  
            $table->decimal('price')->nullable(); 
            $table->text('description')->nullable(); 
            $table->decimal('discount_price')->nullable();
            $table->string('slug')->nullable(); 
            $table->integer('quantity')->default(0);
            $table->boolean('show_sale_product')->default(0);
            $table->boolean('show_favourite_product')->default(0);
            $table->boolean('show_selection_product')->default(0);
            $table->boolean('showon_women_page')->default(0);
            $table->boolean('showon_men_page')->default(0);
            $table->boolean('showon_discovery_page')->default(0);
            $table->boolean('showon_sale_page')->default(0);
            $table->boolean('showon_collection_page')->default(0);
            $table->boolean('showon_explore_page')->default(0);
            $table->timestamps();  
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
