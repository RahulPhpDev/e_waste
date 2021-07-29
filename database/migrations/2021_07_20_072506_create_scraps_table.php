<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scraps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('user_address_id')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->text('phone',12)->nullable();
            $table->text('quantity', 5)->nullable();
            $table->text('price', 5)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('approved_at')->nullable();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('approved_by')->on('users')->references('id');
            $table->foreign('category_id')->on('categories')->references('id');
            $table->foreign('zone_id')->on('zones')->references('id');
            $table->foreign('user_address_id')->on('user_addresses')->references('id');

            $table->softDeletes();
            $table->timestamps();
        });

       Schema::table('user_addresses', function (Blueprint $table) {
            $table->string('landmark')->nullable()->after('longitute');
            $table->string('active')->default(0)->after('landmark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scraps');
    }
}
