<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'date:d-m-Y',
    ];


    protected $fillable = ['date', 'zone', 'time', 'series', 'criterion', 'user_id',
    'worker_id', 'dog_id', 'technique_id'];
    
    /**
     * Relation one to one reverse Worker
     */
    public function worker(){
        return $this->belongsTo(Workers::class);
    }

    /**
     * Relation one to one reverse Dog
     */
    public function dog(){
        return $this->belongsTo(Dog::class);
    }
    /**
     * Relation one to one Daily
     */
    public function daily(){
        return $this->hasOne(Daily::class);
    }

    /**
     * Relation one to one Obedience
     */
    public function obedience(){
        return $this->hasOne(Obedience::class);
    }

    /**
     * Relation one to one Detection
     */
    public function detection(){
        return $this->hasOne(Detection::class);
    }

    /**
     * Relation one to one Technique
     */
    public function technique(){
        return $this->hasOne(technique::class);
    }
}
