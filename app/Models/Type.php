<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];
    
    /**
     * Relation one to many Daily
     */
    public function dailies(){
        return $this->hasMany(Daily::class);
    }
    
}
