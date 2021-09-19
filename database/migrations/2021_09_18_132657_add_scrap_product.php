<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\MigrationHindiColumnTrait;

class AddScrapProduct extends Migration
{
    use MigrationHindiColumnTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrap_product', function ($table) {
            $table->id();
            $table->string('name', 500)->nullable();
          
            $table->text('description')->nullable();

            $table->unsignedBigInteger('scrap_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('quantity', 5)->nullable();
            $table->text('price', 5)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->foreign('scrap_id')->on('scraps')->references('id');
            $table->foreign('category_id')->on('categories')->references('id');


  //            // $table->text('address')->after('zip_code')->nullable();
  //           $this->addTranslateColoum($table)->add('description')->after('description')->nullable();
  // $this->addTranslateColoum($table)->add('name')->after('name')->nullable();

            $table->softDeletes();
        }); 

         Schema::table('scraps', function (Blueprint $table) {
            $table->dropForeign(['category_id']);

            $table->dropColumn(['name', 'quantity', 'price']);
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::
        Schema::dropIfExists('scrap_product');
    }
}
