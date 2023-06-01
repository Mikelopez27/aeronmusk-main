<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Section;
use Illuminate\Http\Request;
class GroupController extends Controller
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
        $Post = Group::join('grades', 'groups.grade_id', '=', 'grades.id')
                    ->join('sections', 'groups.section_id', '=', 'sections.id')
                    ->select('groups.id as id','grades.name as Grado', 'sections.name as Seccion', 'groups.activado as activado')
                    ->paginate(10);

        return view('groups.index', ['marcas' => $Post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::get();
        $sections = Section::get();

        return view('groups.new',['grades'=>$grades],['sections'=>$sections]);
    }

    public function edit($id)
    {
        $group = Group::find($id);
        $grades = Grade::get();
        $sections = Section::get();

        return view('groups.edit', ['group' => $group,'grades'=>$grades,'sections'=>$sections]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Group::create([
            'grade_id'=>$request->input('grades')[0],
            'section_id'=>$request->input('sections')[0]
        ]);
        
        
        // Guardar el nivel en la base de datos
        
        return redirect('admin/groups');
        
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarestado($id, Request $request)
    {
        $marca = Group::findOrFail($id);
        $marca->activado = !$marca->activado;
        $marca->save();


        return redirect()->back()->with('success', 'Grupo cambiado exitosamente.');

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
            'grade_id' => 'required',
            'section_id' => 'required'
        ]);

        // Buscar la marca a actualizar en la base de datos
        $marca = Group::findOrFail($id);
        $data = $request->all();
        
        // Actualizar los datos de la marca con los valores recibidos del formulario
        $marca->grade_id = $data['grade_id'];
        $marca->section_id = $data['section_id'];
        
        

        // Guardar los cambios en la base de datos
        $marca->save();
        return redirect()->route('admin.groups.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id, Group $marca)
    {
        $marca = Group::findOrFail($id);
        $marca->activado = !$marca->activo;
        $marca->save();

        return redirect()->back()->with('success', 'Grupo cambiado exitosamente.');
    }
}
