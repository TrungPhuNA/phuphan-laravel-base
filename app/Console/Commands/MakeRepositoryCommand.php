<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepositoryCommand extends Command
{
    /**
     * Tên và chữ ký của command.
     */
    protected $signature = 'make:repository {name : The name of the repository (e.g., User)} {--path= : Custom path to generate the files}';

    /**
     * Mô tả command.
     */
    protected $description = 'Generate a Repository and RepositoryInterface';

    /**
     * Thực thi command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $customPath = $this->option('path');

        // Nếu truyền path, sử dụng path được truyền; nếu không, sử dụng path mặc định
        $basePath = $customPath ?? base_path('app');
        $interfacePath = "{$basePath}/Repositories/Contracts/{$name}RepositoryInterface.php";
        $repositoryPath = "{$basePath}/Repositories/Eloquent/{$name}Repository.php";

        // Xác định namespace dựa trên path
        $interfaceNamespace = $this->generateNamespace($interfacePath, $basePath);
        $repositoryNamespace = $this->generateNamespace($repositoryPath, $basePath);

        // Nội dung của Interface
        $interfaceContent = <<<EOT
<?php

namespace {$interfaceNamespace};

use AtCore\\CoreRepo\\Repositories\\Contracts\\BaseRepositoryInterface;

interface {$name}RepositoryInterface extends BaseRepositoryInterface
{
    // Add your custom methods here
}
EOT;

        // Nội dung của Repository
        $repositoryContent = <<<EOT
<?php

namespace {$repositoryNamespace};

use AtCore\\CoreRepo\\Repositories\\Eloquent\\BaseRepository;
use {$interfaceNamespace}\\{$name}RepositoryInterface;

class {$name}Repository extends BaseRepository implements {$name}RepositoryInterface
{
    // Implement your methods here
}
EOT;

        // Tạo thư mục nếu chưa tồn tại
        $this->ensureDirectoryExists(dirname($interfacePath));
        $this->ensureDirectoryExists(dirname($repositoryPath));

        // Kiểm tra và tạo file Interface
        if (!file_exists($interfacePath)) {
            file_put_contents($interfacePath, $interfaceContent);
            $this->info("Created: {$interfacePath}");
        } else {
            $this->warn("File already exists: {$interfacePath}");
        }

        // Kiểm tra và tạo file Repository
        if (!file_exists($repositoryPath)) {
            file_put_contents($repositoryPath, $repositoryContent);
            $this->info("Created: {$repositoryPath}");
        } else {
            $this->warn("File already exists: {$repositoryPath}");
        }

        $this->info("Repository and Interface for {$name} created successfully.");
    }

    /**
     * Đảm bảo thư mục tồn tại.
     */
    private function ensureDirectoryExists($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    /**
     * Tạo namespace dựa trên đường dẫn file.
     */
    private function generateNamespace($filePath, $basePath)
    {
        $relativePath = str_replace($basePath, '', dirname($filePath));
        $relativePath = trim(str_replace('/', '\\', $relativePath), '\\');

        return 'App\\' . $relativePath;
    }
}
