<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');

            $table->unsignedBigInteger('type_id');


            $table->string('price')->default('0.00');

            $table->unsignedBigInteger('created_by');

            $table->tinyInteger('approved')->default(0);

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');

            $table->foreign('product_id')->references('id')->on('products');

            $table->foreign('type_id')->references('id')->on('types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
