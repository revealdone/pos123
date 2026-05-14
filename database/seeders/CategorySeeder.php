<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Minuman',
            'description' => 'Produk minuman'
        ]);

        Category::create([
            'name' => 'Makanan',
            'description' => 'Produk makanan'
        ]);

        Category::create([
            'name' => 'Gas LPG',
            'description' => 'Gas rumah tangga'
        ]);

        Category::create([
            'name' => 'Sembako',
            'description' => 'Kebutuhan pokok'
        ]);
    }
}
