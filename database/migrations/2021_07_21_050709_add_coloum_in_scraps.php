<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumInScraps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scraps', function (Blueprint $table) {
            $table->text('user_name')->after('user_id')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1->donate,2->sell');
            $table->text('name')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scraps', function (Blueprint $table) {
              $table->dropColumn('user_name');
              $table->dropColumn('type');
              $table->dropColumn('name');
        });
    }
}
