<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database dhardhes_ops to storage/backups';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dbHost = env('DB_HOST');
        $dbPort = env('DB_PORT');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');

        $timestamp = date('Y-m-d_H-i-s');

        $backupDir = storage_path("backups");
        $backupPath = "{$backupDir}/backup_{$dbName}_{$timestamp}.sql";

        $command = "mysqldump --no-tablespaces --host={$dbHost} --port={$dbPort} --user={$dbUser} --password=\"{$dbPass}\" {$dbName} > {$backupPath}";

        $this->info("Starting database backup...");

        exec($command, $output, $result);

        if ($result === 0) {

            $this->info("Backup success!");
            $this->info("File saved to: {$backupPath}");

            $uploadCommand = "rclone copy {$backupPath} gdrive:dhardhes-backups/ops --drive-chunk-size 8M --tpslimit 2 --tpslimit-burst 2";

exec($uploadCommand, $uploadOutput, $uploadResult);

if ($uploadResult === 0) {
    $this->info("Upload ke Google Drive berhasil");
} else {
    $this->error("Upload ke Google Drive gagal");
}

            /*
            |----------------------------------------------------------
            | Delete old backups (> 7 days)
            |----------------------------------------------------------
            */

            $files = glob($backupDir . '/*.sql');
            $now = time();

            foreach ($files as $file) {
                if (is_file($file)) {

                    $fileAge = $now - filemtime($file);

                    if ($fileAge > (7 * 24 * 60 * 60)) {
                        unlink($file);
                        $this->info("Deleted old backup: " . basename($file));
                    }

                }
            }

        } else {

            $this->error("Backup failed.");

        }
    }
}
