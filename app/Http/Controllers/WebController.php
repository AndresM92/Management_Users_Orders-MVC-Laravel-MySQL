<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class WebController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->has('search') && $request->search) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort') && $request->sort) {
            switch ($request->sort) {
                case 'priceAsc':
                    $query->orderBy('precio', 'asc');
                    break;
                case 'priceDesc':
                    $query->orderBy('precio', 'desc');
                    break;
                default:
                    $query->orderBy('nombre', 'asc');
                    break;
            }
        }

        $productos=$query->paginate(2);
        return view('web.index',compact('productos'));
    }



    public function show($id) 
    {
        $producto=Producto::findOrFail($id);
        return view('web.item',compact('producto'));
    }


}
