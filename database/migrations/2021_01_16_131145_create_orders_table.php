<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');

            $table->string('customer');
            $table->string('email')->nullable();
            $table->string('phone');

            $table->boolean('is_delivery');

            $table->foreignId('area_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('address')->nullable();
            
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade');

            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('comment')->nullable();

            $table->float('delivery_fee', 12, 2);
            $table->float('subtotal', 12, 2);
            $table->float('discount', 12, 2);
            $table->float('total', 12, 2);
            $table->foreignId('order_status_id')->constrained();
            $table->foreignId('order_source_id')->constrained();

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
        Schema::dropIfExists('orders');
    }
}
