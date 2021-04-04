<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];
    
    /**
     * Relation one to many Obedicence
     */
    public function obediences(){
        return $this->hasMany(Obedience::class);
    }
}
