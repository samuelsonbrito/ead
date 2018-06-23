<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url')->unique()->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('code')->unique()->nullable();
            $table->string('total_hours', 5)->nullable();
            $table->boolean('published')->nullable();
            $table->boolean('free')->default(false);
            $table->double('price', 10, 2)->nullable();
            $table->double('price_plots', 10, 2)->nullable();
            $table->integer('total_plots')->nullable();
            $table->string('link_buy')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('courses');
    }
}
