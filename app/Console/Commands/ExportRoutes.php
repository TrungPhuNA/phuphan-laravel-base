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
        // Lấy danh sách route
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
//            $output[] = [
//                'method' => implode('|', $route->methods()),
//                'uri' => $route->uri(),
//                'name' => $route->getName() ?? 'N/A',
//                'action' => $route->getActionName(),
//            ];
            $this->warn("=== URI : ".$route->uri()." |  Name: ".$route->getName() ?? 'N/A');
            $data = [
                "name"        => $route->getName() ?? 'N/A',
                "uri"         => $route->uri(),
                "guard_name"  => "web",
                'method'      => implode('|', $route->methods()),
                "created_at"  => Carbon::now(),
                'description' => $route->defaults['description'] ?? 'No description',
            ];
            Permission::updateOrInsert([
                "name" => $route->getName() ?? 'N/A',
            ], $data);
        }
    }
}
