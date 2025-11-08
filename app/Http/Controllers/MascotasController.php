<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MascotaRequest;
use App\Models\Mascota;
use App\Models\OwnerPet;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Enums\GenerMascota;
use App\Mail\HistorialGeneratedMail;
use Carbon\Carbon;


class MascotasController extends Controller
{

    public function index(Request $request)
    {
        //$this->authorize('veter-');
        $text = $request->input('text');

        $registro = Mascota::with('owner')
            ->where(function ($query) use ($text) {
                $query->where('name_pet', 'like', "%{$text}%")
                    ->orWhere('gener', 'like', "%{$text}%");
            })
            ->whereHas('owner', function ($query) use ($text) {
                $query->where('name', 'like', "%{$text}%");
                $query->where('email', 'like', "%{$text}%");
            })
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

    public function mostrarImagen($filename)
    {
        $path = storage_path('app/private/mascotas/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }


    public function edit(string $id)
    {
        //$this->authorize('veter-');
        $mascota = Mascota::with('owner')->findOrFail($id);
        $generos = GenerMascota::cases();
        return view('mascota.action', compact('mascota', 'generos'));
    }

    public function update(MascotaRequest $request, string $id)
    {


        $owner_pet = Mascota::with('owner')->findOrFail($id);
        $owner_pet->owner->update([
            'name' => $request->name,
            'email' => $request->email,
            'N_cellphone' => $request->N_cellphone,
            'address' => $request->address,
        ]);

        $registro_imagen = $owner_pet->imagen;
        $sufijo = strtolower(Str::random(2));
        $image = $request->file('imagen');

        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/mascotas', $nombreImagen);
            $old_image = 'uploads/mascotas/' . $registro_imagen;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $registro_imagen = $nombreImagen;
        }


        $mascota1 = Mascota::findOrFail($id);

        $mascota1->update([
            'name_pet' => $request->name_pet,
            'specie' => $request->specie,
            'breed' => $request->breed,
            'gener' => $request->gener,
            'date_birth' => $request->date_birth,
            'medical_history' => $request->medical_history,
            'imagen' => $registro_imagen,
        ]);

        /*
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
        */
        return redirect()->route('mascotas.index')->with('mensaje', 'Registro actualizado correctamente');
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

        $registro = Mascota::with('owner')->findOrFail($id);

        $pdf = Pdf::setOptions([
            'isRemoteEnabled' => true,
            'chroot' => public_path(),
        ])->loadView('pdf.historial_clinico_mascota', compact('registro'))
            ->setPaper('letter', 'portrait');

        //$pdf = Pdf::loadView('pdf.historial_clinico_mascota', compact('registro'));
        $fileName = 'Historial_clinico_' . $registro->name_pet . '.pdf';
        $filePath = 'temp/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        // Enviar correo con el PDF adjunto
        Mail::to($registro->owner->email)->send(new HistorialGeneratedMail($filePath, $registro));

        // Eliminar el PDF después del envío
        Storage::disk('public')->delete($filePath);

        return redirect()->route('mascotas.index')->with('mensaje', 'El historial clinico de ' . $registro->name_pet . ' fue enviado');
    }

    public function verEnLinea(string $id)
    {
        $registro = Mascota::with('owner')->findOrFail($id);
        $pdf = Pdf::setOptions([
            'isRemoteEnabled' => true,
            'chroot' => public_path(),
        ])->loadView('pdf.historial_clinico_mascota', compact('registro'))
            ->setPaper('letter', 'portrait');

        $fileName = 'Historial_clinico_' . $registro->name_pet . '.pdf';
        $filePath = 'temp/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());

        // Enviar correo con el PDF adjunto

        // Eliminar el PDF después del envío
        Storage::disk('public')->delete($filePath);


        return $pdf->stream('reporte.pdf');
    }
}
