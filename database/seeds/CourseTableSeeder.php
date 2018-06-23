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
        App\Models\Course::create([
            'name' => 'JavaFX para iniciantes',
            'description' => 'Uma descrição qualquer 1',
            'url' => 'javafx-para-iniciantes',
            'user_id' => 1,
            'category_id' => 1,
        ]);

        App\Models\Course::create([
            'name' => 'VueJS para iniciantes',
            'description' => 'Uma descrição qualquer 2',
            'url' => 'vuejs-para-iniciantes',
            'user_id' => 1,
            'category_id' => 1,
        ]);
    }
}
