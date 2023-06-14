<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('usertype')->comment('0 = admin, 1 = user')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '09123456789',
                'password' => '$2y$10$D7UMeBiSfBB3TtXqADB/xe1cTkP8fezswuz.JifQVvfdjJK4fmHwO',
                'usertype' => 0,
                'created_at' => '2023-06-15 01:47:39',
                'updated_at' => '2023-06-15 01:47:39'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
