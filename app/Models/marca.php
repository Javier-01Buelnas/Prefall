<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marca extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'imagen'];
    

    //Relacion uno a muchos
    public function productos(){
        return $this->hasMany(producto::class);
    }
    //Relacion Muchos a muchos
    public function categorias(){
        return $this->belongsToMany(categoria::class);
    }
}
