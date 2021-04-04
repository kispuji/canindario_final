<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Workers extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'age', 'profession', 'user_id'];

    /**
     * Relation one to one reverse with User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relation one to one with Address
     */
    public function address(){
        return $this->hasOne(Address::class);
    }

    /**
     * Relation one to many with Dog
     */
    public function dogs(){
        return $this->hasMany(Dog::class, 'worker_id');
    }

    /**
     * Relation one to many with Dailies
     */
    public function trainings(){
        return $this->hasMany(Training::class);
    }
}
