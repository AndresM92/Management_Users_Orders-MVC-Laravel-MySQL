<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MascotaRequest;
use App\Models\Mascota;
use App\Models\OwnerPet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Enums\GenerMascota;
use App\Mail\HistorialGeneratedMail;


class MascotasController extends Controller
{

    public function index(Request $request)
    {
        //$this->authorize('veter-');
        $text = $request->input('text');

        $registro = Mascota::with('owner')->where('name_pet', 'like', "%{$text}%")
            //->orWhere('name_owner', 'like', "%{$text}%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('mascota.index', compact('registro', 'text'));
    }


    public function create()
    {
        //$this->authorize('veter-');
        $generos = GenerMascota::cases();
        return view('mascota.action', compact('generos'));
    }


    public function store(MascotaRequest $request)
    {

        //$this->authorize('veter-');
        $owner = new OwnerPet();
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->N_cellphone = $request->N_cellphone;
        $owner->address = $request->address;
        $owner->save();

        $mascota = new Mascota();
        $mascota->name_pet = $request->name_pet;
        $mascota->specie = $request->specie;
        $mascota->breed = $request->breed;
        $mascota->gener = $request->gener;
        $mascota->date_birth = $request->date_birth;
        $mascota->medical_history = $request->medical_history;
        
        $sufijo = strtolower(Str::random(2));
        $image = $request->file('imagen');
        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/mascotas', $nombreImagen);
            $mascota->imagen = $nombreImagen;
        }

        $mascota->owner_id = $owner->id;
        $mascota->save();
        /*

        $registro_imagen = null;
        $owner_pet = OwnerPet::create([
            'name' => $request->name,
            'email' => $request->email,
            'N_cellphone' => $request->N_cellphone,
            'address' => $request->address,
        ]);

        $sufijo = strtolower(Str::random(2));
        $image = $request->file('imagen');
        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/mascotas', $nombreImagen);
            $registro_imagen = $nombreImagen;
        }

        $owner_pet->mascotas()->create([
            'name_pet' => $request->name_pet,
            'specie' => $request->specie,
            'breed' => $request->breed,
            'gener' => $request->gener,
            'date_birth' => $request->date_birth,
            'medical_history' => $request->medical_history,
            'imagen' => $registro_imagen,
        ]);*/

        return redirect()->route('mascotas.index')->with('mensaje', 'Registro agregado correctamente');
    }


    public function show(string $id)
    {
        //$this->authorize('veter-');
    }


    public function edit(string $id)
    {
        //$this->authorize('veter-');
        $mascota = Mascota::with('owner')->findOrFail($id);
        $generos = GenerMascota::cases();
        return view('mascota.action', compact('mascota','generos'));
    }


    public function update(MascotaRequest $request, string $id)
    {
        //$this->authorize('veter-');
        $registro = Mascota::findOrFail($id);
        $registro->name_pet = $request->input('name_pet');
        $registro->breed = $request->input('breed');
        $registro->age = $request->input('age');
        $registro->name_owner = $request->input('name_owner');
        $registro->email_owner = $request->input('email_owner');
        $registro->historial_clinico = $request->input('historial_clinico');
        $sufijo = strtolower(Str::random(2));
        $image = $request->file('imagen');
        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/mascotas', $nombreImagen);
            $old_image = 'uploads/mascotas/' . $registro->imagen;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $registro->imagen = $nombreImagen;
        }

        $registro->save();
        return redirect()->route('mascotas.index')->with('mensaje', 'Registro ' . $registro->name_pet . ' actualizado correctamente');
    }


    public function destroy(string $id)
    {
        //$this->authorize('veter-');
        $registro = Mascota::findOrFail($id);
        $old_image = 'uploads/mascotas/' . $registro->imagen;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        $registro->delete();
        return redirect()->route('mascotas.index')->with('mensaje', 'Registro ' . $registro->name_pet . ' eliminado correctamente');
    }

    public function send_historial(string $id)
    {

        /*
        $registro = Mascota::find($id);
        $historial = $registro->historial_clinico;

       if (empty($historial)) {
            return back()->with('mensaje', 'El historial clínico está vacío.');
        }

        Mail::to($registro->email_owner)->send(new HistorialGeneratedMail($registro, $historial)); 
        return redirect()->route('mascotas.index')->with('mensaje', 'El historial clinico de ' . $registro->name_pet . ' fue enviado');
        */

        $registro = Mascota::findOrFail($id);
        $url = URL::temporarySignedRoute(
            'pdf.ver',
            now()->addMinutes(2),
            ['id' => $id]
        );
        Mail::to($registro->email_owner)->send(new HistorialGeneratedMail($url));
        return redirect()->route('mascotas.index')->with('mensaje', 'El historial clinico de ' . $registro->name_pet . ' fue enviado');
    }

    public function verEnLinea(string $id)
    {
        //$registro = Mascota::findOrFail($id);

        $registro = [
            'id' => $id,
            'nombre' => 'Luna',
            'especie' => 'Canino',
            'raza' => 'Golden Retriever',
            'sexo' => 'Hembra',
            'edad' => 3,
            'color' => 'Dorado',
            'propietario' => 'María López',
            'telefono' => '555-123-4567',
            'correo' => 'maria@example.com',
            'direccion' => 'Calle Falsa 123, Ciudad',
            'historial' => [
                ['fecha' => '2025-05-12', 'procedimiento' => 'Vacuna antirrábica', 'observaciones' => 'Sin reacciones'],
                ['fecha' => '2025-08-10', 'procedimiento' => 'Desparasitación', 'observaciones' => 'Todo normal'],
            ],
            'diagnostico' => 'Alergia leve en la piel',
            'tratamiento' => 'Aplicar crema antihistamínica y control semanal',
        ];

        $pdf = Pdf::loadView('pdf.historial_clinico_mascota', compact('registro'))
            ->setOptions(['isRemoteEnabled' => true])
            ->setPaper('letter', 'portrait');

        return $pdf->stream('reporte.pdf');
    }
}
