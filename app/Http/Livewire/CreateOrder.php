<?php

namespace App\Http\Livewire;

use App\Models\Estado;
use App\Models\Localidad;
use App\Models\Municipio;
use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CreateOrder extends Component
{
    public $envio_type = 1;
    public $contact, $phone, $address, $references, $costo_envio = 0;
    public $estados, $municipios = [], $localidades = [];
    public $estado_id = "", $municipio_id = "", $localidad_id = "";

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required'

    ];

    public function mount()
    {
        $this->estados = Estado::all();
    }

    //resetear validacion
    public function updatedEnvioType($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'estado_id',
                'municipio_id',
                'localidad_id',
                'address',
                'references'
            ]);
        }
    }

    public function updatedEstadoId($value)
    {

        $this->municipios = Municipio::where('estado_id', $value)->get();
        $this->reset(['municipio_id', 'localidad_id']);
    }
    public function updatedMunicipioId($value)
    {
        $municipio = Municipio::find($value);
        $this->costo_envio = $municipio->costo;

        $this->localidades = Localidad::where('municipio_id', $value)->get();
        $this->reset('localidad_id');
    }

    public function create_order()
    {

        $rules = $this->rules;
        if ($this->envio_type == 2) {
            $rules['estado_id'] = 'required';
            $rules['municipio_id'] = 'required';
            $rules['localidad_id'] = 'required';
            $rules['address'] = 'required';
            $rules['references'] = 'required';
        }

        $this->validate($rules);

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contacto = $this->contact;
        $order->telefono = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->costo_envio = 0;
        $order->total = $this->costo_envio + Cart::subtotal();
        $order->contenido = Cart::content();

        if ($this->envio_type == 2) {
            $order->costo_envio = $this->costo_envio;
            $order->direccion = $this->address;
            $order->referencias = $this->references;
            /* $order->estado_id = $this->estado_id;
            $order->municipio_id = $this->municipio_id;
            $order->localidad_id = $this->localidad_id; */
            $order->envio = json_encode([
                'estado' => Estado::find($this->estado_id)->nombre,
                'municipio' => Municipio::find($this->municipio_id)->nombre,
                'localidad' => Localidad::find($this->localidad_id)->nombre,
                'direccion' => $this->address,
                'referencia' => $this->references
            ]);
            
        }

        $order->save();

        foreach (Cart::content() as $item) {
            discount($item);
        }
        
        Cart::destroy();

        return redirect(route('orders.payment', $order));
    }
    public function render()
    {
        return view('livewire.create-order');
    }
}
