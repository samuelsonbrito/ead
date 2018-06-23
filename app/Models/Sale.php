<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['user_id', 'course_id', 'transaction', 'status'];

    public function getResults(array $data, int $total): object
    {
        if(!isset($data['filter']) && !isset($data['user_id']) && !isset($data['course_id']) && !isset($data['status']))
            return $this->with('course')->paginate($total);
                
        return $this->with('course')->where(function($query) use ($data){

            if(isset($data['user_id'])){
                $query->where('user_id', $data['user_id']);
            }

            if(isset($data['course_id'])){
                $query->where('course_id', $data['course_id']);
            }

            if(isset($data['status'])){
                $query->where('status', $data['status']);
            }

        })->paginate($total);
        
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
