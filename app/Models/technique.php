<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technique extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];
    
    /**
     * Relation one to many Trainings
     */
    public function trainings(){
        return $this->hasMany(Training::class);
    }
}
