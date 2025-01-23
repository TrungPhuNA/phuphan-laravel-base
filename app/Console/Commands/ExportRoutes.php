<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class ExportRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes();
        $dataRoute = [];
        foreach ($routes as $route) {
            $group = $route->getAction('prefix') ?? 'N/A';
            $data = [
                "name"        => $route->getName() ?? 'N/A',
                "uri"         => $route->uri(),
                "guard_name"  => "web",
                "group"       => $group,
                'method'      => implode('|', $route->methods()),
                "created_at"  => Carbon::now(),
                'description' => $route->defaults['description'] ?? 'No description',
            ];
            if (!empty($route->getName())) {
                Permission::updateOrInsert([
                    "name" => $route->getName() ?? 'N/A',
                ], $data);
            }
            $dataRoute[] = $data;
        }
        $this->table(['Name', 'URI', 'Guard', 'group', 'method', 'created_at','Description'], $dataRoute);
    }
}
