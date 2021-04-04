<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obedience extends Model
{
    use HasFactory;

    protected $fillable = ['positives', 'negatives', 'failures', 'duration', 'training_id',
     'order_id'];

    /**
     * Relation one to one reverse Training
     */
    public function training(){
        return $this->belongsTo(Training::class);
    }

    /**
     * Relation one to one reverse Order
     */
    public function order(){
        return $this->belongsTo(Order::class);
    }

}
