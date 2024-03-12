<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Международные новости'],
            ['name' => 'Политика'],
            ['name' => 'Экономика'],
            ['name' => 'Наука и технологии'],
            ['name' => 'Спорт'],
            ['name' => 'Культура'],
            ['name' => 'Общество'],
            ['name' => 'Здоровье'],
            ['name' => 'Образование'],
            ['name' => 'Экология'],
            ['name' => 'Бизнес'],
            ['name' => 'Развлечения'],
            ['name' => 'Технологии'],
            ['name' => 'Путешествия'],
            ['name' => 'Автомобили']
        ]);
    }
}
