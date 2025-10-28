<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable=['codigo','name'];

    public function producto()
    {
        return $this->hasMany(Producto::class);
    }
}
