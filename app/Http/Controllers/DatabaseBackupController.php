<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DatabaseBackupController extends Controller
{
    public function index()
    {
        $backupDir = storage_path('backups');

        $files = [];

        if (is_dir($backupDir)) {

            $allFiles = scandir($backupDir);

            foreach ($allFiles as $file) {

                if ($file !== '.' && $file !== '..') {

                    $files[] = [
                        'name' => $file,
                        'size' => filesize($backupDir . '/' . $file),
                        'date' => date(
                            'Y-m-d H:i:s',
                            filemtime($backupDir . '/' . $file)
                        )
                    ];

                }

            }

        }

        return view('database_backup', compact('files'));
    }

    public function run()
    {
        Artisan::call('db:backup');

        return redirect('/database-backup')
            ->with('success','Database backup berhasil dibuat');
    }

    public function download($file)
    {
        $path = storage_path('backups/' . $file);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}