<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name');
            $table->string('slug')->unique();
            $table->longText('item_description');
            $table->text('item_summary')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('item_type')->default('undefined');
            $table->string('featured_image')->nullable();
            $table->string('featured_content')->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->string('item_status')->default('published');
            $table->string('item_quantity_unit')->default('no_unit');
            $table->integer('item_price')->unsigned()->index()->nullable();
            $table->integer('item_quantity')->unsigned()->index()->nullable();
            $table->integer('view_count')->unsigned()->index()->default(0);
            // $table->integer('tag_id')->unsigned()->index()->default(1);
            $table->string('key_words')->nullable();
            $table->timestamps();

           // $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
