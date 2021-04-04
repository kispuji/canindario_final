<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sustance extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    /**
     * Relation one to many Detection
     */
    public function detections(){
        return $this->hasMany(Detection::class);
    }
}
