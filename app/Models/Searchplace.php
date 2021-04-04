<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detection;

class Searchplace extends Model
{
    use HasFactory;

    /**
     * Relation many to many Detection
     */
    public function detections(){
        $this->belongsToMany(Detection::class);
    }

}
