<?php

use Database\Seeders\UserSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Artisan::call('migrate', [
            '--path' => 'database/migrations/2014_10_12_000000_create_users_table.php',
        ]);
        Artisan::call('migrate', [
            '--path' => 'database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php',
        ]);
        Artisan::call('migrate', [
            '--path' => 'database/migrations/2019_08_19_000000_create_failed_jobs_table.php',
        ]);
        Artisan::call('migrate', [
            '--path' => 'database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php',
        ]);

        Artisan::call('db:seed', [
            '--class' => 'UserSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
