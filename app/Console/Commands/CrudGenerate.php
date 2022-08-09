<?php

namespace App\Console\Commands;

use App\Models\Routing;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class CrudGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $name = $this->argument('name');
        $this->model($name);
        $this->controller($name);
        $this->view($name);
        $this->view_add($name);
        $this->view_edit($name);
        $this->migration($name);

        $this->info('Crud generate successfully for ' . $name);
    }

    protected function getStub($type){
        return file_get_contents(resource_path("views/admin/stubs/$type.stub"));
    }

    //Model Stub
    protected function model($name){

        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('model')
        );

        file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
        $this->info('Model created successfully');
    }

    

    //Controller Stub
    protected function controller($name){

        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub('controller')
        );

        file_put_contents(app_path("/Http/Controllers/Admin/{$name}Controller.php"), $controllerTemplate);
        $this->info('Controller created successfully');
    }

    //View List Stub
    protected function view($name){

        $requestTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub('view')
        );

        $folder = strtolower($name);
        if(!file_exists($path = base_path("/resources/views/admin/pages/{$folder}")))
            mkdir($path, 0777, true);

        file_put_contents(base_path("/resources/views/admin/pages/{$folder}/{$folder}.blade.php"), $requestTemplate);
        $this->info('Views created successfully');
    }

    protected function view_add($name){

        $requestTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub('view_add')
        );

        $folder = strtolower($name);
        if(!file_exists($path = base_path("/resources/views/admin/pages/{$folder}")))
            mkdir($path, 0777, true);

        file_put_contents(base_path("/resources/views/admin/pages/{$folder}/{$folder}_add.blade.php"), $requestTemplate);
    }

    protected function view_edit($name){

        $requestTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub('view_edit')
        );

        $folder = strtolower($name);
        if(!file_exists($path = base_path("/resources/views/admin/pages/{$folder}")))
            mkdir($path, 0777, true);

        file_put_contents(base_path("/resources/views/admin/pages/{$folder}/{$folder}_edit.blade.php"), $requestTemplate);
    }

    //Migration Stub
    protected function migration($name){

        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [strtolower(Str::plural($name))],
            $this->getStub('Migration')
        );

        $datePrefix = date('Y_m_d_His');
        $name  = Str::plural(strtolower($name));
        $name  = Str::plural($name);

        file_put_contents(base_path("/database/migrations/{$datePrefix}_create_{$name}_table.php"), $requestTemplate);
        $this->info('Migration created successfully');
    }

}
