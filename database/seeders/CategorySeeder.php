<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $this->createCategory('Недвижимость', [
            'Квартиры',
            'Дома',
            'Комнаты',
            'Земельные участки',
            'Гаражи и машиноместа',
        ]);

        $this->createCategory('Транспорт', [
            'Автомобили',
            'Мотоциклы',
            'Велосипеды',
            'Автодома',
        ]);

        $this->createCategory('Электроника', [
            'Смартфоны',
            'Компьютеры',
            'Телевизоры',
            'Наушники',
        ]);

        $this->createCategory('Одежда и аксессуары', [
            'Женская одежда',
            'Мужская одежда',
            'Обувь',
            'Аксессуары',
        ]);

        $this->createCategory('Бытовая техника', [
            'Стиральные машины',
            'Холодильники',
            'Пылесосы',
            'Кофемашины',
        ]);

        $this->createCategory('Хобби и спорт', [
            'Книги',
            'Игрушки',
            'Спортивные товары',
            'Музыкальные инструменты',
        ]);

        $this->createCategory('Услуги', [
            'Услуги персонального помощника',
            'Ремонт и строительство',
            'Кулинарные услуги',
            'Обучение и курсы',
        ]);
    }

    private function createCategory($categoryName, array $subcategories)
    {
        $category = Category::factory()->create([
            'name' => $categoryName,
            'parent_id' => null,
        ]);

        foreach ($subcategories as $subcategory) {
            Category::factory()->create([
                'name' => $subcategory,
                'parent_id' => $category->id,
            ]);
        }
    }

}

