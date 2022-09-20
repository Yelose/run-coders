<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Noticia;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        $admin = User::where('email', 'admin@admin.com')->first();
        DB::statement("SET foreign_key_checks=1");
        if ($admin) {
            $admin->delete();
        }
        $admin = User::create(
            [
                "name" => "admin",
                "email" => "admin@admin.com",
                "password" => Hash::make("admin")
            ]
        );
        Noticia::factory()
            ->count(21)->create();
    }
}
