<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class AdminSystemLogRequestController extends Controller
{
    public function index()
    {
        $filePath = storage_path('logs/request.log');

        if (!File::exists($filePath)) {
            return response()->json(['message' => 'Log file not found'], 404);
        }

        $logs = [];
        $lines = File::lines($filePath)->reverse()->take(100)->toArray(); // Lấy 100 dòng mới nhất

        foreach ($lines as $line) {
            if (preg_match('/\{.*\}/', $line, $matches)) {
                $jsonData = json_decode($matches[0], true);
                if ($jsonData) {
                    $logs[] = $jsonData;
                }
            }
        }
        return view('admin.system.request-logs.index', compact('logs'));
    }

    // Tải file log
    public function download()
    {
        $filePath = storage_path('logs/request.log');

        if (!File::exists($filePath)) {
            return response()->json(['message' => 'Log file not found'], 404);
        }

        return Response::download($filePath, 'request.log');
    }

    // Xóa file log
    public function destroy()
    {
        $filePath = storage_path('logs/request.log');

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        return redirect()->back()->with('success', 'Log file deleted successfully');
    }
}
