<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
    
class producto extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $guarded = ['id','created_at','updated_at'];
 

    public function getRouteKeyName(){
        return "slug";
    }
    // Relacion uno a muchos inversa
    public function marca(){
        return $this->belongsTo(marca::class);
    }
    
    public function subcategoria(){
        return $this->belongsTo(subcategoria::class);
    }

    //Relacion uno a muchos polimorfica
    public function images(){
        return $this->morphMany(image::class, "imageable");
    }  
}
