<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('title1');
            $table->text('title2');
            $table->text('video_url');
            $table->text('des1');
            $table->text('feature');
            $table->string('image');
            $table->string('old_price');
            $table->string('new_price');
            $table->string('phone');
            $table->string('pay_text');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_pages');
    }
};
