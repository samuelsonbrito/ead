<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description', 'image', 'user_id', 'category_id'];

    public function getResults($name = null)
    {
        return $this->where('name', 'LIKE', "%{$name}%")->get();
    }
}
