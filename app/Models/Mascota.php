<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\GenerMascota;


class Mascota extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'name_pet', 'specie', 'breed', 'gener', 'date_birth', 'medical_history', 'imagen'];
    protected $casts = [
        'date_birth' => 'date',
    ];

    // Calcular la edad
    public function getEdadAttribute()
    {
        
        return $this->date_birth ? $this->date_birth->age : null;
    }

    public function owner()
    {
        return $this->belongsTo(OwnerPet::class);
    }
}
