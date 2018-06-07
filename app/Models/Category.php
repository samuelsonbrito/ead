<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function getResults(array $data, int $total): object
    {
        if(!isset($data['filter']) && !isset($data['name']) && !isset($data['description']))
            return $this->paginate($total);
        
        
        return $this->where(function($query) use ($data){

            if(isset($data['filter'])){
                $filter = $data['filter'];
                $query->where('name', $filter);
                $query->orWhere('description', 'LIKE', '%{$filter}%');
            }

            if(isset($data['name'])){
                $query->where('name', $data['name']);
            }

            if(isset($data['description'])){
                $description = $data['description'];
                $query->where('description', 'LIKE', '%{$description}%');
            }
        })->paginate($total);
        
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
