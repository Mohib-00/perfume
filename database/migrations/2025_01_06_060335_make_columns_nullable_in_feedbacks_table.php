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
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->string('review_title')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->text('message_review')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->string('review_title')->nullable(false)->change();
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->text('message_review')->nullable(false)->change();
        });
    }
};
