<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Perfume;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@rosee.test'], [
            'name' => 'Rosée Curator', 'role' => 'admin', 'password' => Hash::make('password'),
        ]);
        User::updateOrCreate(['email' => 'client@rosee.test'], [
            'name' => 'Guest Client', 'role' => 'customer', 'password' => Hash::make('password'),
        ]);

        foreach ([
            ['name' => 'Floral', 'description' => 'Petals, peony and soft white florals.', 'perfume' => 'Petale No. 04', 'price' => 84],
            ['name' => 'Woody', 'description' => 'Warm woods with a quietly confident trail.', 'perfume' => 'Bois Serein', 'price' => 98],
            ['name' => 'Fresh', 'description' => 'Bright citrus and clean aquatic notes.', 'perfume' => 'Lumière Fraîche', 'price' => 76],
        ] as $item) {
            $category = Category::updateOrCreate(['name' => $item['name']], [
                'slug' => Str::slug($item['name']), 'description' => $item['description'], 'is_active' => true,
            ]);
            Perfume::updateOrCreate(['name' => $item['perfume']], [
                'category_id' => $category->id, 'brand' => 'Rosée', 'slug' => Str::slug($item['perfume']),
                'size' => '50ml', 'price' => $item['price'], 'stock' => 18, 'description' => $item['description'],
                'is_featured' => $item['name'] !== 'Fresh', 'is_active' => true,
            ]);
        }
    }
}
