<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OwnerPet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'N_cellphone', 'address'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }
}
