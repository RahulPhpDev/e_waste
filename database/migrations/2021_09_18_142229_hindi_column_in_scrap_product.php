<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\MigrationHindiColumnTrait;

class HindiColumnInScrapProduct extends Migration
{
    use MigrationHindiColumnTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scrap_product', function (Blueprint $table) {
            $this->addTranslateColoum($table)->add('description')->after('description')->nullable();
            $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scrap_product', function (Blueprint $table) {
            //
        });
    }
}
