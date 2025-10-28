<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('product-list');
        $text = $request->input('text');
        /*
        $registros = Producto::where('nombre', 'like', "%{$text}%")
            ->orWhere('codigo', 'like', "%{$text}%")
            ->orderBy('id', 'desc')
            ->paginate(10);
        */
        $registros = Producto::with('categoria')
            ->where(function ($query) use ($text) {
                $query->where('nombre', 'like', "%{$text}%")
                    ->orWhere('codigo', 'like', "%{$text}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('producto.index', compact('registros', 'text'));
    }


    public function create()
    {
        $this->authorize('product-create');
        $categorias = Categoria::all();
        return view('producto.action',compact('categorias'));
    }


    public function store(ProductoRequest $request)
    {
        $this->authorize('product-create');
        $registro = new Producto();
        $registro->codigo = $request->input('codigo');
        $registro->nombre = $request->input('nombre');
        $registro->precio = $request->input('precio');
        $registro->categoria_id = $request->input('categoria');
        $registro->utilidad = $request->input('utilidad');
        $registro->descripcion = $request->input('descripcion');
        $registro->precio_venta = (($request->input('precio') * $request->input('utilidad')) / 100) + $registro->precio;
        $sufijo = strtolower(Str::random(2));
        $image = $request->file('imagen');
        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/productos', $nombreImagen);
            $registro->imagen = $nombreImagen;
        }

        $registro->save();
        return redirect()->route('productos.index')->with('mensaje', 'Registro ' . $registro->nombre . ' agregado correctamente');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $this->authorize('product-edit');
        $registro = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('producto.action', compact('registro', 'categorias'));
    }


    public function update(ProductoRequest $request, string $id)
    {
        $this->authorize('product-edit');
        $registro = Producto::findOrFail($id);
        $registro->codigo = $request->input('codigo');
        $registro->nombre = $request->input('nombre');
        $registro->precio = $request->input('precio');
        $registro->categoria_id = $request->input('categoria');
        $registro->utilidad = $request->input('utilidad');
        $registro->descripcion = $request->input('descripcion');
        $registro->precio_venta = (($request->input('precio') * $request->input('utilidad')) / 100) + $registro->precio;
        $sufijo = strtolower(Str::random(2));
        $image = $request->file('imagen');
        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/productos', $nombreImagen);
            $old_image = 'uploads/productos/' . $registro->imagen;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $registro->imagen = $nombreImagen;
        }

        $registro->save();
        return redirect()->route('productos.index')->with('mensaje', 'Registro ' . $registro->nombre . ' actualizado correctamente');
    }


    public function destroy(string $id)
    {
        $this->authorize('product-delete');
        $registro = Producto::findOrFail($id);
        $old_image = 'uploads/productos/' . $registro->imagen;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        $registro->delete();
        return redirect()->route('productos.index')->with('mensaje', 'Registro ' . $registro->nombre . ' eliminado correctamente');
    }
}
