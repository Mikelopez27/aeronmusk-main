<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use Illuminate\Http\Request;

use App\Models\Niveledu;


class Marcas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Nivel access|Nivel create|Nivel edit|Nivel delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Nivel create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Nivel edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Nivel delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Post = EducationLevel::paginate(4);

        return view('marcas.index', ['marcas' => $Post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.new');
    }

    

    public function edit($id)
    {
        $grade = EducationLevel::find($id);
        return view('marcas.edit', ['marcas' => $grade]);
    }
    





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $marca = new EducationLevel;
        
        $marca->name = $data['name'];
        $marca->description = $data['description'];
        
        // Guardar el nivel en la base de datos
        $marca->save();
        
        return redirect()->back()->with('success', 'Estado de Nivel educativo creado exitosamente.');
        // return back()->with('message', [
        //     'text' => 'Estado de Nivel educativo creado exitosamente.',
        //     'icon' => 'success',
        //     'txtp' => 'Exito',
        //     'route' => route('admin.marcas.index'),
        // ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarEstado($id, Request $request)
    {
        $marca = EducationLevel::findOrFail($id);
        $marca->activado = !$marca->activado;
        $marca->save();


        return redirect()->back()->with('success', 'Estado de Nivel educativo cambiado exitosamente.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        // Buscar la marca a actualizar en la base de datos
        $marca = Niveledu::findOrFail($id);
        $data = $request->all();
        
        // Actualizar los datos de la marca con los valores recibidos del formulario
        $marca->name = $data['name'];
        $marca->description = $data['descripcion'];
        

        // Guardar los cambios en la base de datos
        $marca->save();
        return redirect()->route('admin.marcas.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id, EducationLevel $marca)
    {
        $marca = EducationLevel::findOrFail($id);
        $marca->activado = !$marca->activo;
        $marca->save();

        return redirect()->back()->with('success', 'Estado de Nivel educativo cambiado exitosamente.');
    }
}