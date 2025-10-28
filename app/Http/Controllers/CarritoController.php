<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function add(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);
        $cantidad = $request->cantidad ?? 1;

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            $carrito[$producto->id] = [
                'codigo' => $producto->codigo,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'imagen' => $producto->imagen,
                'cantidad' => $cantidad,
            ];
        }
        $noti_cart= collect($carrito)->sum('cantidad');
        session()->put('carrito', $carrito);
        //return redirect()->back()->with('mensaje', 'Producto agregado al carrito');
        return response()->json
        ([
        'status' => 'success',
        'message' => 'Producto agregado al carrito',
        'cartCount' => $noti_cart,
        ]);
    }

    public function show_items()
    {
        $carrito = session('carrito', []);
        return view('web.pedido', compact('carrito'));
    }

    public function sum(Request $request)
    {
        $productoId = $request->producto_id;
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] += 1;
            session()->put('carrito', $carrito);
        }
        return redirect()->back()->with('mensaje', 'Cantidad actualizada en el carrito');
    }

    public function rest(Request $request)
    {
        $productoId = $request->producto_id;
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            if ($carrito[$productoId]['cantidad'] > 1) {
                $carrito[$productoId]['cantidad'] -= 1;
            } else {
                unset($carrito[$productoId]);
            }
            session()->put('carrito', $carrito);
        }
        return redirect()->back()->with('mensaje', 'Cantidad actualizada en el carrito');
    }

    public function delete($id)
    {
        $carrito = session()->get('carrito');
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return redirect()->back()->with('mensaje', 'Producto eliminado');
    }

    public function empty_car()
    {
        session()->forget('carrito');
        return redirect()->back()->with('mensaje', 'Carrito vacio');
    }
}