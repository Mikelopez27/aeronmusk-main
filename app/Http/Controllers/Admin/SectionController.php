<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Random\Engine\Secure;

class SectionController extends Controller
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
       // $this->middleware('role_or_permission:Nivel edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Nivel delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Post = Section::paginate(10);

        return view('section.index', ['marcas' => $Post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('section.new');
    }

    public function edit($id)
    {
        $grade = Section::find($id);
        return view('section.edit', ['grade' => $grade]);
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
        $marca = new Section();
        $marca->name = $data['name'];
        
        
        // Guardar el nivel en la base de datos
        $marca->save();
        
        return redirect('admin/section');
        
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarestado($id, Request $request)
    {
        $marca = Section::findOrFail($id);
        $marca->activado = !$marca->activado;
        $marca->save();


        return redirect()->back()->with('success', 'Seccion cambiado exitosamente.');

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
            'name' => 'required',
        ]);

        // Buscar la marca a actualizar en la base de datos
        $marca = Section::findOrFail($id);
        $data = $request->all();
        
        // Actualizar los datos de la marca con los valores recibidos del formulario
        $marca->name = $data['name'];
        
        

        // Guardar los cambios en la base de datos
        $marca->save();
        return redirect()->route('admin.section.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id, Section $marca)
    {
        $marca = Section::findOrFail($id);
        $marca->activado = !$marca->activo;
        $marca->save();

        return redirect()->back()->with('success', 'Seccion cambiado exitosamente.');
    }
}
