<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\MigrationHindiColumnTrait;

class CreateSubCategoriesTable extends Migration
{
    use MigrationHindiColumnTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sub_categories');
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('description');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->on('categories')->references('id');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
            $this->addTranslateColoum($table)->add('description')->after('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
