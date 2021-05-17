<?php

use Illuminate\Database\Seeder;
use App\Models\Idea;


class IdeaSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Idea::class)->create([
            'id' => '1',
            'seller_id' => '2',
            'category_id' => '3',
            'name' => 'sample1',
            'description' => 'sample1',
            'content' => 'samplesamplesample',
            'price' => '111',
            'state' => 'editable',
        ]);
        factory(Idea::class)->create([
            'id' => '2',
            'seller_id' => '2',
            'category_id' => '1',
            'name' => 'sample2',
            'description' => 'sample2',
            'content' => 'samplesamplesample',
            'price' => '222',
            'state' => 'editable',
        ]);
        factory(Idea::class)->create([
            'id' => '3',
            'seller_id' => '2',
            'category_id' => '4',
            'name' => 'sample3',
            'description' => 'sample3',
            'content' => 'samplesamplesample',
            'price' => '333',
            'state' => 'editable',
        ]); 
        factory(Idea::class)->create([
            'id' => '4',
            'seller_id' => '2',
            'category_id' => '5',
            'name' => 'sample4',
            'description' => 'sample4',
            'content' => 'samplesamplesample',
            'price' => '444',
            'state' => 'editable',
        ]);   
        factory(Idea::class)->create([
            'id' => '5',
            'seller_id' => '2',
            'category_id' => '4',
            'name' => 'sample5',
            'description' => 'sample5',
            'content' => 'samplesamplesample',
            'price' => '555',
            'state' => 'editable',
        ]);  
        factory(Idea::class)->create([
            'id' => '6',
            'seller_id' => '2',
            'category_id' => '7',
            'name' => 'sample6',
            'description' => 'sample6',
            'content' => 'samplesamplesample',
            'price' => '666',
            'state' => 'editable',
        ]);
        factory(Idea::class)->create([
            'id' => '7',
            'seller_id' => '2',
            'category_id' => '1',
            'name' => 'sample7',
            'description' => 'sample7',
            'content' => 'samplesamplesample',
            'price' => '777',
            'state' => 'editable',
        ]);    
        factory(Idea::class)->create([
            'id' => '8',
            'seller_id' => '2',
            'category_id' => '6',
            'name' => 'sample8',
            'description' => 'sample8',
            'content' => 'samplesamplesample',
            'price' => '888',
            'state' => 'editable',
        ]);
        factory(Idea::class)->create([
            'id' => '9',
            'seller_id' => '2',
            'category_id' => '6',
            'name' => 'sample9',
            'description' => 'sample9',
            'content' => 'samplesamplesample',
            'price' => '999',
            'state' => 'editable',
        ]);
        factory(Idea::class)->create([
            'id' => '10',
            'seller_id' => '2',
            'category_id' => '4',
            'name' => 'sample10',
            'description' => 'sample',
            'content' => 'samplesamplesample',
            'price' => '1111',
            'state' => 'editable',
        ]);        
    }
}
