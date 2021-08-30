<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\MigrationHindiColumnTrait;
use Illuminate\Support\Facades\Artisan;
// use App\Database\TranslateUser;
class AddHindiColumnsInUsers extends Migration
{
    use MigrationHindiColumnTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
              $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
        });
        Schema::table('user_addresses', function (Blueprint $table) {
              $this->addTranslateColoum($table)->add('flat')->after('flat')->nullable();
              $this->addTranslateColoum($table)->add('area')->after('area')->nullable();
              $this->addTranslateColoum($table)->add('landmark')->after('landmark')->nullable();
        });

        // Artisan::call('db:seed' , ['--class' => TranslateUserSeeder::class ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
