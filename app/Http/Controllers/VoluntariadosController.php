<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Voluntariado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class VoluntariadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'subscribirse']]);
    }

    public function index(Request $request) {
        return Voluntariado::with('empresa')->get();
    }

    public function store(Request $request) {
        $this->validate($request, [
            'descripcion' => 'required',
            'ciudad' => 'required',
            'image' => 'required'
        ]);

        $input = $request->all();

        if($file = $request->file('image')) {
            $name = $file->getClientOriginalName();
            Storage::put($name, file_get_contents($file->getRealPath()));
            $file->move('storage/', $name);
            $input['image'] = $name;
        }

        $empresa = Empresa::findOrFail($input['empresa']);
        $voluntariado = new Voluntariado($input);
        $voluntariado->empresa()->associate($empresa);
        $voluntariado->image = $input['image'];
        $voluntariado->save();
        return $voluntariado;
    }

    public function show(Request $request, $id) {
        return Voluntariado::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $voluntariado = Voluntariado::findOrFail($id);
        $input = $request->all();
        $voluntariado->update($input);

        if($file = $request->file('image')) {
            $name = $file->getClientOriginalName();
            Storage::put($name, file_get_contents($file->getRealPath()));
            $file->move('storage/', $name);
            $voluntariado->image = $name;
            $voluntariado->save();
        }

        return $voluntariado;
    }

    public function subscribirse(Request $request, $id) {
        try {
            $voluntariado = Voluntariado::findOrFail($id);
            $user_id = [$request->user];
            $suscripciones = $voluntariado->users;
            if (sizeof($suscripciones) != 0) {
                foreach ($suscripciones as $suscripcion) {
                    if ($suscripcion->user_id == $user_id) {
                        return response()->json(['error' => 'Ya has firmado esta peticion'], 403);
                    }
                }
            }
            $voluntariado->users()->attach(intval($user_id));
            return response()->json(['message' => 'Peticion firmada con exito', 'voluntariado' => $voluntariado], 201);
        } catch (\Throwable$th) {
            return response()->json(['error' => 'La peticion no se ha podido firmar'], 500);
        }
    }

    public function usuariosVoluntariado(Request $request, $id) {
        $voluntariado = Voluntariado::findOrFail($id);
        return $voluntariado->users;
    }

    public function delete(Request $request, $id) {
        $voluntariado = Voluntariado::findOrFail($id);
        $voluntariado->delete();
        return $voluntariado;
    }
}
