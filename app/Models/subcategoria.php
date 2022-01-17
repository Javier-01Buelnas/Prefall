<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategoria extends Model
{
    use HasFactory;
    
    protected $guarded = ['id','created_at','updated_at'];

    public function getRouteKeyName()
    {
        return "slug";
    }
    # Relacion uno a muchos
    public function productos()
    {
        return $this->hasMany(producto::class);
    }
    # Relacion uno a muchos inversa
    public function categoria(){
        return $this->belongsTo(categoria::class);
    }
}
