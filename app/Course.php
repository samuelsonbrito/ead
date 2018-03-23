<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description', 'image', 'user_id'];

    public function getResults($name = null)
    {
        return $this->where('name', 'LIKE', "%{$name}%")->get();
    }
}
