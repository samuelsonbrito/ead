<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Course::create([
            'name' => 'Curso de Teste',
            'description' => 'Uma descrição qualquer',
            'user_id' => 1
        ]);
    }
}
