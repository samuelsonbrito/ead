<?php

use Illuminate\Database\Seeder;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Classroom::create([
            'name' => 'Vídeo Aula 1',
            'description' => 'Uma descrição qualquer',
            'module_id' => 1,
        ]);
    }
}
