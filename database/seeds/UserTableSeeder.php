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
        App\Models\User::create([
            'name' => 'Samuelson Admin',
            'email' => 'samuelson@descompila.com.br',
            'password' => bcrypt('123456'),
            'level' => 1
        ]);

        App\Models\User::create([
            'name' => 'Samuelson Aluno',
            'email' => 'usuario@descompila.com.br',
            'password' => bcrypt('123456'),
            'level' => 2
        ]);
    }
}
