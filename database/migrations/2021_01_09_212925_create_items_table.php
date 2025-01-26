<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('image_path')->nullable();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->longText('des')->nullable();
            $table->float('price', 12, 2)->default(0);
            $table->float('discount')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('is_spicy');
            $table->boolean('is_vegan');
            $table->boolean('is_vegetarian');
            $table->boolean('is_gluten_free');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}
