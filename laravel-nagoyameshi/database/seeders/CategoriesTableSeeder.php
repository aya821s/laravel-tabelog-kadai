<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_names = [
            '味噌煮込みうどん', 'みそかつ', 'どて煮', '鉄板ナポリタン', 'きしめん', '手羽先唐揚げ', 'エビフライ', '台湾ラーメン', 'あんかけスパ', '名古屋コーチン', 'ひつまぶし', '喫茶店', 'その他'
        ];
    }
}
