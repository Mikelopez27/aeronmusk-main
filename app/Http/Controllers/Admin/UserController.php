<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= User::latest()->get();

        return view('setting.user.index',['users'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::get();
        return view('setting.user.new',['roles'=>$roles]);
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
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);

      

        $user = User::create([
            'name'=>$request->name,
            'apaterno'=>$request->apaterno,
            'amaterno'=>$request->amaterno,
            'fechanacimiento'=>$request->fechanacimiento,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'rol_id' => $request->input('roles')[0]
        ]);
        $user->syncRoles($request->roles);

        return back()->with('message', [
            'text' => 'El usuario ha sido creado con éxito',
            'icon' => 'success',
            'txtp' => 'Exito',
            'route' => route('admin.users.index'),
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $role = Rol::get();
        $user->roles;
       return view('setting.user.edit',['user'=>$user,'roles' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'=>'required',
            'apaterno'=>'required',
            'amaterno'=>'required',
            'fechanacimiento'=>'required',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'rol_id' => 'required'
        ]);

        if($request->password != null){
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);
        return back()->with('message', [
            'text' => 'El usuario ha sido actualizado con éxito',
            'icon' => 'success',
            'txtp' => 'Exito',
            'route' => route('admin.users.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->withSuccess('Usuario eliminado');
    }
}
