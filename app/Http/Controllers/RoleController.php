<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleController extends Controller
{

    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('role-list');
        $text = $request->input('text');
        $registros = Role::with('permissions')
                    ->where('name', 'like', "%{$text}%")
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        return view('role.index', compact('registros', 'text'));
    }


    public function create()
    {
        $this->authorize('role-create');
        $permissions = Permission::all();
        return view('role.action', compact('permissions'));
    }


    public function store(Request $request)
    {
        $this->authorize('role-create');
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);
        $registro = Role::create(['name' => $request->name]);
        $registro->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('mensaje', 'Rol ' . $registro->name . 'asignado con exito');
    }


    public function show(string $id) {}


    public function edit(string $id)
    {
        $this->authorize('role-edit');
        $registro = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('role.action', compact('registro', 'permissions'));
    }


    public function update(Request $request, string $id)
    {
        $this->authorize('role-edit');
        $registro = Role::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:roles,name,' . $registro->id,
            'permissions' => 'required|array',
        ]);

        $registro->update(['name' => $request->name]);
        $registro->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('mensaje', 'Rol ' . $registro->name . 'actualizado con exito');
    }

    public function destroy(string $id)
    {
        $this->authorize('role-delete');
        $registro = Role::findOrFail($id);
        $registro->delete();
        return redirect()->route('roles.index')->with('mensaje ', $registro->name . 'eliminado correctamente');
    }
}
