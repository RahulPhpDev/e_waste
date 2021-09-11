<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\MigrationHindiColumnTrait;

class AddColumInZoneTable extends Migration
{
    use MigrationHindiColumnTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->text('description')->after('name')->nullable();
            $table->text('address')->after('zip_code')->nullable();
            $this->addTranslateColoum($table)->add('description')->after('description')->nullable();
            $this->addTranslateColoum($table)->add('address')->after('address')->nullable();
            $table->string('phone_number', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zone', function (Blueprint $table) {
            $table->dropIfExists('zone');
        });
    }
}
