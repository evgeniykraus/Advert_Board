<?php

namespace Database\Seeders;

use App\Models\Advert;
use Illuminate\Database\Seeder;

class AdvertSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i < 21; $i++) {
            Advert::factory()->create([
                'title' => "Квартира_$i",
                'description' => "Тестовое описание_$i",
                'category_id' => 2,
                'creator_id' => 1,
                'price' => rand(10000, 100000),
            ]);
            Advert::factory()->create([
                'title' => "Машина_$i",
                'description' => "Тестовое описание_$i",
                'category_id' => 8,
                'creator_id' => 1,
                'price' => rand(100, 100000),
            ]);
        }
    }
}
