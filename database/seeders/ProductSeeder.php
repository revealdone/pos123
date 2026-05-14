<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Aqua Botol',
            'barcode' => 'BRG001',
            'purchase_price' => 3000,
            'selling_price' => 5000,
            'stock' => 50,
            'unit' => 'pcs'
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Indomie Goreng',
            'barcode' => 'BRG002',
            'purchase_price' => 2500,
            'selling_price' => 3500,
            'stock' => 100,
            'unit' => 'pcs'
        ]);

        Product::create([
            'category_id' => 3,
            'name' => 'Gas LPG 3kg',
            'barcode' => 'BRG003',
            'purchase_price' => 18000,
            'selling_price' => 22000,
            'stock' => 20,
            'unit' => 'tabung'
        ]);

        Product::create([
            'category_id' => 4,
            'name' => 'Beras Ramos 5kg',
            'barcode' => 'BRG004',
            'purchase_price' => 65000,
            'selling_price' => 72000,
            'stock' => 30,
            'unit' => 'karung'
        ]);
    }
}
