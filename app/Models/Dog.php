<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'race', 'specialty', 'marking', 'microchip', 
    'amount_food', 'user_id', 'worker_id'];

    /**
     * Relation one to one reverse with User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relation one to one reverse with Worker
     */
    public function worker(){
        return $this->belongsTo(Workers::class);
    }

    /**
     * Relation one to one reverse with Users
     */
    public function trainings(){
        return $this->hasMany(Training::class);
    }

}
