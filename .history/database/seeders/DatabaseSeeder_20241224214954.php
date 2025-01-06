<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    protected static ?string $password;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mangun Wirayuda',
            'email' => 'mangunwirayuda@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);
        User::factory()->create([
            'name' => 'Admin Cabang',
            'email' => 'admincabang01@taibahshop.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);
        User::factory()->create([
            'name' => 'Customer Umum',
            'email' => 'tamu@taibahshop.com',
            'email_verified_at' => '',
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'name' => 'Baruno S Samudera',
            'email' => 'baruno@taibahshop.com',
            'email_verified_at' => '',
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'name' => 'Retno Ayu',
            'email' => 'retno@taibahshop.com',
            'email_verified_at' => '',
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'name' => 'Kasir 001',
            'email' => 'kasir001@taibahshop.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);
        User::factory()->create([
            'name' => 'Kasir 002',
            'email' => 'kasir002@taibahshop.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);
        User::factory()->create([
            'name' => 'Kasir 003',
            'email' => 'kasir003@taibahshop.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);
        User::factory()->create([
            'name' => 'Kasir 004',
            'email' => 'kasir004@taibahshop.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => 1,
        ]);
        User::factory(10)->create();

        Branch::factory()->create([
            'name' => 'Gringsing',
            'slug' => 'gringsing',
            'is_active' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Branch::factory()->create([
            'name' => 'Limpung',
            'slug' => 'limpung',
            'is_active' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        Branch::factory()->create([
            'name' => 'Pegandon',
            'slug' => 'pegandon',
            'is_active' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Category::factory()->create([
            'name' => 'Marketplace',
            'slug' => 'marketplace',
            'is_active' => 1,
        ]);
        Category::factory()->create([
            'name' => 'Makanan',
            'slug' => 'makanan',
            'is_active' => 1,
        ]);
        Category::factory()->create([
            'name' => 'Minuman',
            'slug' => 'minuman',
            'is_active' => 1,
        ]);
        Category::factory()->create([
            'name' => 'Camilan',
            'slug' => 'camilan',
            'is_active' => 1,
        ]);
        Category::factory()->create([
            'name' => 'Paket',
            'slug' => 'paket',
            'is_active' => 1,
        ]);

        Brand::factory()->create([
            'name' => 'Taibah Fried Chicken',
            'slug' => 'taibah-fried-chicken',
            'is_active' => 1,
        ]);
        Brand::factory()->create([
            'name' => 'Taibah Wedang',
            'slug' => 'taibah-wedang',
            'is_active' => 1,
        ]);
        Brand::factory()->create([
            'name' => 'FitGoat',
            'slug' => 'fitgoat',
            'is_active' => 1,
        ]);
        Brand::factory()->create([
            'name' => 'Armio',
            'slug' => 'armio',
            'is_active' => 1,
        ]);
    }
}
