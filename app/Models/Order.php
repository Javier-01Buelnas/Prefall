<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'status','created_at', 'updated_at'];

    //al generar la orden
    const PENDIENTE = 1;
    //al pagar orden
    const RECIBIDO = 2;
    //en camino
    const ENVIADO = 3;
    //orden finalizada
    const ENTREGADO = 4;
    //eliminar orden
    const ANULADO = 5;

    // relacion uno a muchos inversa
    public function estado(){
        return $this->belongsTo(Estado::class);
    }
    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }
    public function localidad(){
        return $this->belongsTo(Localidad::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
