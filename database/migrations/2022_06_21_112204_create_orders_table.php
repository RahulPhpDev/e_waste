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
            $table->string('order_num')->nullable();
            $table->unsignedBigInteger('user_id')->on('users')->references('id');
            $table->unsignedBigInteger('product_id')->on('products')->references('id');
            $table->string('price')->default('0.00');
            $table->string('quantity')->default('1');
            $table->tinyInteger('status')->default(0);
            $table->date('dispatch_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->on('orders')->references('id');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('alternative_phone')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('address')->nullable();
            $table->string('landmark')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('comment')->nullable();
            $table->string('admin_comment')->nullable();
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
        Schema::dropIfExists('order_addresses');
    }
}
