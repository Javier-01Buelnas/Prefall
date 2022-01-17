<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preventa extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo('App\Models\Producto');
    }
    public function pedido(){
        return $this->belongsTo('App\Models\Pedido');
    }
}
