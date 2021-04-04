<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Daily extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'duration', 'meters', 'training_id'];

    /**
     * Relation one to one reverse Training
     */
    public function training(){
        return $this->belongsTo(Training::class);
    }

    /**
     * Relation one to one reverse Type
     */
    public function type(){
        return $this->belongsTo(Type::class);
    }
}
