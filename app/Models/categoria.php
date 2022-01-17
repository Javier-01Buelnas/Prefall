<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre','slug','imagen','icono'];

    public function getRouteKeyName()
    {
        return "slug";
    }
    //Relacion uno a muchos
    public function subcategorias(){
        return $this->hasMany(subcategoria::class);
    }
    //Relacion muchos a muchos
    public function marcas(){
        return $this->belongsToMany(marca::class);
    }
    //
    public function productos(){
        return $this->hasManyThrough(producto::class, subcategoria::class);
    }
}
