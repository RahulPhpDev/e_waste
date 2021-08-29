<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\MigrationHindiColumnTrait;


class AddHindiColumnsInTables extends Migration
{
    use MigrationHindiColumnTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('districts', function (Blueprint $table) {
             $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
        });


        Schema::table('categories', function (Blueprint $table) {
             $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
             $this->addTranslateColoum($table)->add('description')->after('description')->nullable();

        });



        Schema::table('articles', function (Blueprint $table) {
             $this->addTranslateColoum($table)->add('title')->after('title')->nullable();
             $this->addTranslateColoum($table)->add('description')->after('description')->nullable();
        });



        Schema::table('pages', function (Blueprint $table) {
             $this->addTranslateColoum($table)->add('type')->after('type')->nullable();
             $this->addTranslateColoum($table)->add('description')->after('description')->nullable();
        });


        Schema::table('products', function (Blueprint $table) {
             $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
             $this->addTranslateColoum($table)->add('description')->after('description')->nullable();
        });


        Schema::table('scraps', function (Blueprint $table) {
             $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
             $this->addTranslateColoum($table)->add('user_name')->after('user_name')->nullable();
        });


        Schema::table('types', function (Blueprint $table) {
             $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
             $this->addTranslateColoum($table)->add('description')->after('description')->nullable();
        });


        Schema::table('zones', function (Blueprint $table) {
             $this->addTranslateColoum($table)->add('name')->after('name')->nullable();
             $this->addTranslateColoum($table)->add('landmark')->after('landmark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('districts', function (Blueprint $table) {
             $this->addTranslateColoum($table)->dropColumn('name');
        });

        Schema::table('categories', function (Blueprint $table) {
             $this->addTranslateColoum($table)->dropColumn('name');
             $this->addTranslateColoum($table)->dropColumn('description');
        });

        Schema::table('articles', function (Blueprint $table) {
             $this->addTranslateColoum($table)->dropColumn('title');
             $this->addTranslateColoum($table)->dropColumn('description');
        });

        Schema::table('pages', function (Blueprint $table) {
             $this->addTranslateColoum($table)->dropColumn('type');
             $this->addTranslateColoum($table)->dropColumn('description');
        });

        Schema::table('products', function (Blueprint $table) {
             $this->addTranslateColoum($table)->dropColumn('name');
             $this->addTranslateColoum($table)->dropColumn('description');
        });

        Schema::table('scraps', function (Blueprint $table) {
             $this->addTranslateColoum($table)->dropColumn('name');
             $this->addTranslateColoum($table)->dropColumn('user_name');
        });

        Schema::table('types', function (Blueprint $table) {
             $this->addTranslateColoum($table)->dropColumn('name');
             $this->addTranslateColoum($table)->dropColumn('description');
        });

        Schema::table('zones', function (Blueprint $table) {
             $this->addTranslateColoum($table)->dropColumn('name');
             $this->addTranslateColoum($table)->dropColumn('landmark');
        });

    }
}
