<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class MigrateOldAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-old-admins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate old admin users from the users table to the new admins table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting migration of old admins...');

        // Temukan semua user yang merupakan admin
        $oldAdmins = User::where('is_admin', 1)->get();

        if ($oldAdmins->isEmpty()) {
            $this->info('No old admins found in the users table. Nothing to migrate.');
            return 0;
        }

        foreach ($oldAdmins as $oldAdmin) {
            // Cek apakah admin dengan email yang sama sudah ada di tabel admins
            $exists = Admin::where('email', $oldAdmin->email)->exists();

            if ($exists) {
                $this->warn("Admin with email {$oldAdmin->email} already exists in the admins table. Skipping.");
                continue;
            }

            // Buat entri baru di tabel admins
            Admin::create([
                'name' => $oldAdmin->name,
                'email' => $oldAdmin->email,
                'password' => $oldAdmin->password, // Password sudah di-hash, jadi kita salin langsung
                'created_at' => $oldAdmin->created_at,
                'updated_at' => $oldAdmin->updated_at,
            ]);

            $this->info("Admin '{$oldAdmin->name}' migrated successfully.");
        }

        $this->info('Migration complete!');
        return 0;
    }
}