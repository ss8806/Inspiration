<?php

use Illuminate\Database\Seeder;
use App\Models\Review;


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Review::class)->create([
            'id'      => 1,
            'review'    => '１.とても悪い',
            'sort_no' => 1,
        ]);
        factory(Review::class)->create([
            'id'      => 2,
            'review'    => '２.悪い',
            'sort_no' => 2,
        ]);
        factory(Review::class)->create([
            'id'      => 3,
            'review'    => '３.普通',
            'sort_no' => 3,
        ]);
        factory(Review::class)->create([
            'id'      => 4,
            'review'    => '４.良い',
            'sort_no' => 4,
        ]);
        factory(Review::class)->create([
            'id'      => 5,
            'review'    => '５.とても良い',
            'sort_no' => 5,
        ]);
    }
}
