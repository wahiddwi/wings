<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Product::create([
            'product_name' => 'So Klin Pewangi',
            'price' => 10000,
            'currency' => 'IDR',
            'discount' => 10,
            'dimension' => '13 cm x 10 cm',
            'unit' => 'Pcs',
            'images' => 'soklin-pewangi.jpg'
        ]);

        Product::create([
            'product_name' => 'So Klin Liquid',
            'price' => 12000,
            'currency' => 'IDR',
            'discount' => 0,
            'dimension' => '13 cm x 10 cm',
            'unit' => 'Pcs',
            'images' => 'soklin-liquid.jpg'
        ]);

        Product::create([
            'product_name' => 'Mama Lemon',
            'price' => 8000,
            'currency' => 'IDR',
            'discount' => 0,
            'dimension' => '13 cm x 10 cm',
            'unit' => 'Pcs',
            'images' => 'mama-lemon.jpg'
        ]);
    }
}
