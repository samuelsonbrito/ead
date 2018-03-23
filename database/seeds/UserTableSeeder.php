<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Samuelson Brito',
            'email' => 'samuelson@descompila.com.br',
            'password' => bcrypt('123456'),
            'level' => 1
        ]);
    }
}
