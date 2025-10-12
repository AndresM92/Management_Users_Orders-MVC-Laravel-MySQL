<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;
use App\Models\PedidoDetalle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $text = $request->input('texto');
        $query = Pedido::with('user', 'detalles.producto')->orderBy('id', 'desc');

        if (auth()->user()->can('pedido-list')) {
        } elseif (auth()->user()->can('pedido-view')) {
            $query->where('user_id', auth()->id());
        } else {
            abort(403, 'No tiene permisos para ver pedidos');
        }

        if (!empty($text)) {
            $query->whereHas('user', function ($q) use ($text) {
                $q->where('name', 'like', "%{$text}%");
            });
        }
        //dd($query->toSql());

        $registros = $query->paginate(10);

        return view('pedido.index', compact('registros', 'text'));
    }

    public function realizar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->back()->with('mensaje', 'El carrito esta vacio');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'estado' => 'pendiente'
            ]);

            foreach ($carrito as $productoId => $item) {
                PedidoDetalle::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $productoId,
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                ]);
            }

            session()->forget('carrito');
            DB::commit();
            return redirect()->route('carrito.mostrar')->with('mensaje', 'Pedido realizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un error al procesar el pedido');
        }
    }

    public function changeState(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $stateNew = $request->input('estado');
        $statePermit = ['enviado', 'anulado', 'cancelado'];

        if (!in_array($stateNew, $statePermit)) {
            abort(400, 'Estado no valido');
        }

        if (in_array($stateNew, ['enviado', 'anulado'])) {
            if (!auth()->user()->can('pedido-anulate')) {
                abort(403, 'No tiene Permisos para cambiar a enviado o anulado');
            }
        }

        if ($stateNew === 'cancelado') {
            if (!auth()->user()->can('pedido-cancel')) {
                abort(403, 'No tiene para cancelar pedidos');
            }
        }
        $pedido->estado=$stateNew;
        $pedido->save();

        return redirect()->back()->with('mensaje','el estado del pedido fue actualizado a '.ucfirst($stateNew). "");
    }
}
