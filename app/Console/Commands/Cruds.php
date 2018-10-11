<?php

namespace App\Console\Commands;

use File;
use Storage;
use App\Role;
use App\User;
use Exception;
use ReflectionException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Cruds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud{foldername}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creation of Views Based on CRUD';

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
     * @return mixed
     */
    public function handle()
    {

        
        $headers = [];
       
       
        //Ask If user needs a Controller
        if($this->confirm('Do you wish to create Contoller?')){

            $controller_name=$this->ask('Enter Controller Name');
            try {
                app()->make('App\Http\Controllers\\'.$controller_name);
                $this->info('Created Already');
            } catch(ReflectionException $e) {
                // use custom /resources/views/errors/404.blade.php to display $pageName
                //View::share('', $nameFormat);
              //  $this->warn(404);
              Artisan::call('make:controller',['name'=>ucfirst($controller_name),'--resource'=>'resource']);
               
            }
    
    
           }

           //Ask If user needs a Controller
        if($this->confirm('Do you wish to create Model?')){

            $model_name=$this->ask('Enter Model Name');
            try {
                app()->make('App\\'.$model_name);
                $this->info('Created Already');
            } catch(ReflectionException $e) {
                // use custom /resources/views/errors/404.blade.php to display $pageName
                //View::share('', $nameFormat);
              //  $this->warn(404);
              Artisan::call('make:model',['name'=>ucfirst($model_name),'-m'=>'m']);
             
              if($this->confirm('Do You want to Run Migration now?')){

                Artisan::call('migrate');
               }
               else{
    
                //$this->info('Model Created With Out Migrations');
               }
            }
    
    
           }

           
     
        $folder_name = $this->argument('foldername');
      
        $path = base_path('resources/views/'.$folder_name);
        File::makeDirectory($path,0777,true,true);
      // $table='roles';
       $table=$this->ask('TADA!!, Lets Create CRUD View, Specify your table name');
      
      

       
       $columns = \DB::connection()->getSchemaBuilder()->getColumnListing($table);
     
      $table_size= sizeof($columns);

      while($table_size==0){

        $table=$this->ask('OOPS!!, Table Does NOt Exist, Try Again');
      
      

       
        $columns = \DB::connection()->getSchemaBuilder()->getColumnListing($table);
      
       $table_size= sizeof($columns);
      }
       {
        $feild=[];
        for($i=0; $i<sizeof($columns); $i++){
            try{
        $feild[$i] = $this->choice('Select Fields To add, Press Enter to Finish Adding',$columns,null,'1');
            }
            catch (Exception $e){

                break; 
            }
       
       }

    }

 $extends=$this->ask('Enter The Layout You want to Extend?');
 $section=$this->ask('Enter The Section Name');

   
      
       $this->table($headers, [$feild]);
       $types=['string'=>'text','int'=>'number','datetime'=>'datetime-local','text'=>'text','varchar'=>'text'];
        $html='@extends(\''.$extends.'\')';
        $html.='@section(\''.$section.'\')';
       $html.='<div class="row">';
       $html.='<div class="col-md-4">';
       $html.='<form action="table" method="post">';

       for($i=0; $i<sizeof($feild); $i++){

        $t=\DB::getSchemaBuilder()->getColumnType($table, $feild[$i]);
        $tp=$types[$t];
        
        $html.='<div class="form-group">';
        $html.='<label for="'.$feild[$i].'">'.$feild[$i].'</label>';
        $html.='<input type="'.$tp.'" class="form-control" id="'.$feild[$i].'">';

        $html.='</div>';
       }
       $html.='<input type="submit" class="submit btn btn-success">';
       $html.='</form>';
       $html.='</div>';
       $html.='</div>';
       $html.='@endsection';

       
      
       
         Storage::disk('killer')->put($folder_name.'/create.blade.php', $html);
    
         $this->line('-------Thanks------');
      


  

       
    }
}
