<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'id' => '1',
            'name' => 'テストタロウ',
            'email' => 'test@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('testtest'),
        ]);
        factory(User::class)->create([
            'id' => '2',
            'name' => 'テストジロウ',
            'email' => 'test2@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('testtest'),
        ]);
        factory(User::class)->create([
            'id' => '3',
            'name' => 'テストサンタ',
            'email' => 'test3@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('testtest'),
        ]);
    }
}