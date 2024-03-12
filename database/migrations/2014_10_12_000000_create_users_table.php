<?php

use Database\Seeders\UserSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
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
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_blocked')->default(false);
            $table->foreignId('id_role')->references('id')->on('roles');
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => UserSeeder::class]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
