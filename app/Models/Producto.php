<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable=[
        'codigo',
        'nombre',
        'precio',
        'utilidad',
        'descripcion',
        'imagen',
        'categoria_id',
        'precio_venta'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
