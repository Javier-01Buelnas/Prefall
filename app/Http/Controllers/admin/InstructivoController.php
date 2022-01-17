<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\instructivo;
class InstructivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.instructivos.index')->only('index');
        $this->middleware('can:admin.instructivos.store')->only('store');
        $this->middleware('can:admin.instructivos.update')->only('update');
        $this->middleware('can:admin.instructivos.destroy')->only('destroy');
    }
    public function index()
    {
        $instructivos = instructivo::all();
        return view('admin.instructivos.index', compact('instructivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructivos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'slug'=>'required|unique:instructivos',
            'instructivo'=>'file|required'
        ]);
        /* $max_size = (int)ini_get('instructivo_max_filesize') * 10240; */
        $instructivo = $request->all();
       /*  instructivo::create([
            'nombre' => 'nombre',
            'instructivo' => $file -> getClientOriginalName(),
        ]); */
        if ($request->hasFile('instructivo')){
            $producto['instructivo'] = $request->file('instructivo')->store('instructivos','public');
        }
        
        Instructivo::create($instructivo);
        return redirect()->route('admin.instructivos.index', $instructivo)->with('registrar','ok');
    
    }

    public function edit(Instructivo $instructivo)
    {
        
    }

   
    public function update(Request $request, instructivo $instructivo)
    {
        $request->validate([
            'nombre'=>'required',
            'slug'=>"required|unique:instructivos,slug,$instructivo->id",
            'instructivo'=>'required'
        ]);

        $instructivo->update($request->all());
        return redirect()->route('admin.instructivos.edit', $instructivo)->with('info','El registro se actualizo con exito');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructivo $instructivo)
    {
        $instructivo->delete();
        return redirect()->route('admin.instructivos.index')->with('eliminar','ok');
         
    }
}
