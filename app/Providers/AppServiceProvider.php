<?php

namespace App\Providers;

use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Eloquent\AuthRepository;
use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
//        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->bindRepositories();
    }

    public function bindRepositories(): void
    {
        // Lấy danh sách tất cả các file trong Contracts
        $contractPath = app_path('Repositories/Contracts');
        $contracts = collect(scandir($contractPath))
            ->filter(fn ($file) => str_ends_with($file, 'Interface.php'));

        foreach ($contracts as $contract) {
            // Lấy tên class interface và repository
            $interface = "App\\Repositories\\Contracts\\" . pathinfo($contract, PATHINFO_FILENAME);
            $repository = str_replace('Contracts', 'Eloquent', $interface);
            $repository = str_replace('Interface', '', $repository);

            // Kiểm tra xem class repository có tồn tại không
            if (class_exists($repository)) {
                $this->app->bind($interface, $repository);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
