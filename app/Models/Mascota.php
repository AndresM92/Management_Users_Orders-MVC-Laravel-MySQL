<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\GenerMascota;


class Mascota extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'name_ped', 'specie', 'breed', 'gener'=> GenerMascota::class, 'date_birth', 'medical_history', 'imagen'];

    public function owner()
    {
        return $this->belongsTo(OwnerPet::class);
    }
}