<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['name', 'description', 'video', 'views', 'module_id'];

    public function getResults($data, $total)
    {
        if(!isset($data['filter']) && !isset($data['name']) && !isset($data['description']) && !isset($data['module_id']))
            return $this->with('module')->paginate($total);
        
        
        return $this->where(function($query) use ($data){

            if(isset($data['filter'])){
                $filter = $data['filter'];
                $query->where('name', $filter);
                $query->orWhere('description', 'LIKE', '%{$filter}%');
            }

            if(isset($data['name'])){
                $query->where('name', $data['name']);
            }

            if(isset($data['module_id'])){
                $query->where('module_id', $data['module_id']);
            }

            if(isset($data['description'])){
                $description = $data['description'];
                $query->where('description', 'LIKE', '%{$description}%');
            }
            
        })->with('module')->paginate($total);
        
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
