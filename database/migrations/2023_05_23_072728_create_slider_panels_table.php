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
        Schema::create('slider_panels', function (Blueprint $table) {
            $table->id();
            $table->string("name")->default("noname");
            $table->string("title");
            $table->string("description");
            $table->string("image_url");
            $table->boolean("isSlide")->default(true);
            $table->boolean("enabled")->default(true);
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
        Schema::dropIfExists('slider_panels');
    }
};