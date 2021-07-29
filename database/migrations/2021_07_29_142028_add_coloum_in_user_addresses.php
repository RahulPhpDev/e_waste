<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumInUserAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //composer require doctrine/dbal

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->renameColumn('name','flat')->nullable();
            $table->string('area')->after('name')->nullable();
            $table->unsignedBigInteger('district_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            //
        });
    }
}
