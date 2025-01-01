<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  
            $table->foreignId('option_id')->nullable()->constrained('options')->onDelete('set null');  
            $table->integer('quantity')->default(1);  
            $table->decimal('total');  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}