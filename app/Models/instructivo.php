<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instructivo extends Model
{
    protected $fillable=[
        'nombre',
        'slug',
        'instructivo'
    ];
    
    public function getRouteKeyName()
    {
        return "slug";
    }

    use HasFactory;
}
