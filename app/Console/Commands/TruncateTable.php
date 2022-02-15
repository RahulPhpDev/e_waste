<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'truncate:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate the tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Schema::disableForeignKeyConstraints();

        //get all the tables
        $tablesquery = 'show tables';
        $tables = DB::select($tablesquery);
        $constantDb = $this->getConstantOfDatabase($tables);

        foreach ($tables as $table) {
            if ($table->$constantDb != 'migrations') {
                $answar =    $this->choice(
                    "Do you want to truncate " . $table->$constantDb,
                    ['y', 'n'],
                    0,
                    $maxAttempts = null,
                    $allowMultipleSelections = false
                );
                if ($answar == 'y') {
                    $st = "truncate  " .  $table->$constantDb;

                    DB::select($st);
                    DB::statement("ALTER TABLE ".$table->$constantDb ." AUTO_INCREMENT = 1");
                }
            }
        }
        Schema::enableForeignKeyConstraints();
    }

    function getConstantOfDatabase($tables)
    {
        foreach ($tables as $k => $table) {
            $objectArray = array_values(array($table))[0];
            $dbName = array($objectArray)[0];
            return  array_keys(get_object_vars($dbName))[0];
            break;
        }
    }
}
