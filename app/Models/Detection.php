<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    use HasFactory;

    protected $fillable = ['positives', 'negatives', 'failures', 'search_time', 'focus_time',
    'nivel', 'training_id', 'sustance_id'];

    /**
     * Relation one to one reverse Training
     */
    public function training(){
        return $this->belongsTo(Training::class);
    }

    /**
     * Relation one to one reverse Sustances
     */
    public function sustance(){
        return $this->belongsTo(Sustance::class);
    }
}
