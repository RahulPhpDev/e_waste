<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateViewResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a view file';

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
        $path =  $this->argument('file');
        $files =explode( '/', $path);
        // echo count($files);
        $insideFolder = false;
        foreach($files as $key =>  $file)
        {
            $basePath =  realpath(base_path('resources/views/') );

            if ( $key == count($files)-1 )
            {
                if (  $insideFolder  )
                    $basePath = $basePath.'/'.$filePath. '/';

                if (!file_exists($basePath.$file.'.blade.php'))
                     fopen($basePath.'/'.$file.'.blade.php', "w");
                        break;
            }
            else {
                  $filePath = isset($filePath) ? $filePath.'/'.$file : $file;

                    if ( !realpath($basePath.'/'.$filePath))
                     mkdir($basePath.'/'.$filePath, 0777 );
                        $insideFolder = true;
                    }
        }

         $this->info("File is created in ",  $path .'blade.php');

    }
}
