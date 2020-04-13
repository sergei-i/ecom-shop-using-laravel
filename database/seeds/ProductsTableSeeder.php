<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone X 64GB',
                'code' => 'iphone_x_64',
                'description' => 'Отличный продвинутый телефон с памятью на 64 gb',
                'price' => '71990',
                'category_id' => 1,
                'image' => 'products/iphone_x.jpg',
                'new' => rand(0, 1),
                'hit' => rand(0, 1),
                'recommend' => rand(0, 1),
                'count' => rand(0, 3)
            ],
            [
                'name' => 'iPhone X 256GB',
                'code' => 'iphone_x_256',
                'description' => 'Отличный продвинутый телефон с памятью на 256 gb',
                'price' => '89990',
                'category_id' => 1,
                'image' => 'products/iphone_x_silver.jpg',
                'new' => rand(0, 1),
                'hit' => rand(0, 1),
                'recommend' => 0,
                'count' => rand(0, 3)
            ],
            [
                'name' => 'HTC One S',
                'code' => 'htc_one_s',
                'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                'price' => '12490',
                'category_id' => 1,
                'image' => 'products/htc_one_s.png',
                'new' => rand(0, 1),
                'hit' => 0,
                'recommend' => rand(0, 1),
                'count' => rand(0, 3)
            ],
            [
                'name' => 'iPhone 5SE',
                'code' => 'iphone_5se',
                'description' => 'Отличный классический iPhone',
                'price' => '17221',
                'category_id' => 1,
                'image' => 'products/iphone_5.jpg',
                'new' => 0,
                'hit' => rand(0, 1),
                'recommend' => rand(0, 1),
                'count' => rand(0, 3)
            ],
            [
                'name' => 'Наушники Beats Audio',
                'code' => 'beats_audio',
                'description' => 'Отличный звук от Dr. Dre',
                'price' => '20221',
                'category_id' => 2,
                'image' => 'products/beats.jpg',
                'new' => rand(0, 1),
                'hit' => 0,
                'recommend' => 0,
                'count' => rand(0, 3)
            ],
            [
                'name' => 'Камера GoPro',
                'code' => 'gopro',
                'description' => 'Снимай самые яркие моменты с помощью этой камеры',
                'price' => '12000',
                'category_id' => 2,
                'image' => 'products/gopro.jpg',
                'new' => 0,
                'hit' => rand(0, 1),
                'recommend' => 0,
                'count' => rand(0, 3)
            ],
            [
                'name' => 'Камера Panasonic HC-V770',
                'code' => 'panasonic_hc-v770',
                'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                'price' => '27900',
                'category_id' => 2,
                'image' => 'products/video_panasonic.jpg',
                'new' => rand(0, 1),
                'hit' => 0,
                'recommend' => 0,
                'count' => rand(0, 3)
            ],
            [
                'name' => 'Кофемашина DeLongi',
                'code' => 'delongi',
                'description' => 'Хорошее утро начинается с хорошего кофе!',
                'price' => '25200',
                'category_id' => 3,
                'image' => 'products/delongi.jpg',
                'new' => rand(0, 1),
                'hit' => rand(0, 1),
                'recommend' => rand(0, 1),
                'count' => rand(0, 3)
            ],
            [
                'name' => 'Холодильник Haier',
                'code' => 'haier',
                'description' => 'Для большой семьи большой холодильник!',
                'price' => '40200',
                'category_id' => 3,
                'image' => 'products/haier.jpg',
                'new' => 0,
                'hit' => rand(0, 1),
                'recommend' => rand(0, 1),
                'count' => rand(0, 3)
            ],
            [
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'description' => 'Для самых смелых идей',
                'price' => '4200',
                'category_id' => 3,
                'image' => 'products/moulinex.jpg',
                'new' => rand(0, 1),
                'hit' => rand(0, 1),
                'recommend' => 0,
                'count' => rand(0, 3)
            ],
            [
                'name' => 'Мясорубка Bosch',
                'code' => 'bosch',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'price' => '9200',
                'category_id' => 3,
                'image' => 'products/bosch.jpg',
                'new' => rand(0, 1),
                'hit' => 0,
                'recommend' => rand(0, 1),
                'count' => rand(0, 3)
            ],
            [
                'name' => 'Samsung Galaxy J6',
                'code' => 'samsung_j6',
                'description' => 'Современный телефон начального уровня',
                'price' => '11980',
                'category_id' => 1,
                'image' => 'products/samsung_j6.jpg',
                'new' => 0,
                'hit' => rand(0, 1),
                'recommend' => rand(0, 1),
                'count' => rand(0, 3)
            ],
        ]);
    }
}
