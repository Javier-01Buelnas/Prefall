<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'costo', 'estado_id'];

    public function estado(){
        return $this->belongsTo(Estado::class);
    }
    
    public function orders(){
        return $this->hasMany(Order::class);  
    }
    public function localidades(){
        return $this->hasMany(Localidad::class);  
    }
}

