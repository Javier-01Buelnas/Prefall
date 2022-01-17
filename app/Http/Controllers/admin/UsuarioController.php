<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\admin\UsuarioRequest;
use Spatie\Permission\Models\Role;



class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.usuarios.index')->only('index');
        $this->middleware('can:admin.usuarios.edit')->only('edit','update');
        $this->middleware('can:admin.usuarios.create')->only('create');
        $this->middleware('can:admin.usuarios.destroy')->only('destroy');
    }

    public function index()
    {
        $roles = Role::all(); 
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        
        $user = User::create($request->all());
        return redirect()->route('admin.usuarios.index', $user)->with('registrar','ok');
    }

    public function edit(User $usuario)
    { 
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $usuario->roles()->sync($request->roles);
        return redirect()->route('admin.usuarios.edit',$usuario)->with('success','ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('eliminar','ok');
         
    }
}
