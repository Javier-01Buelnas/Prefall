<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'municipio_id'];

    public function orders(){
        return $this->hasMany(Order::class);  
    }
    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }
}
