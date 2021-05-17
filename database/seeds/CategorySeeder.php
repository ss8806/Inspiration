<?php

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class)->create([
            'id'      => 1,
            'name'    => 'マッチング',
            'sort_no' => 1,
        ]);
        factory(Category::class)->create([
            'id'      => 2,
            'name'    => '掲示板',
            'sort_no' => 2,
        ]);
        factory(Category::class)->create([
            'id'      => 3,
            'name'    => 'SNS',
            'sort_no' => 3,
        ]);
        factory(Category::class)->create([
            'id'      => 4,
            'name'    => 'シェアリング',
            'sort_no' => 4,
        ]);
        factory(Category::class)->create([
            'id'      => 5,
            'name'    => 'ECサイト',
            'sort_no' => 5,
        ]);
        factory(Category::class)->create([
            'id'      => 6,
            'name'    => '情報配信',
            'sort_no' => 6,
        ]);
        factory(Category::class)->create([
            'id'      => 7,
            'name'    => 'その他',
            'sort_no' => 7,
        ]);
    }
}
