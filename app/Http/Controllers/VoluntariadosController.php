<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Voluntariado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

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
        ]);

        $input = $request->all();

        $empresa = Empresa::findOrFail($input['empresa']);
        $voluntariado = new Voluntariado($input);
        $voluntariado->empresa()->associate($empresa);
        $voluntariado->save();
        return $voluntariado;
    }

    public function show(Request $request, $id) {
        return Voluntariado::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $voluntariado = Voluntariado::findOrFail($id);
        $voluntariado->update($request->all());
        return $voluntariado;
    }

    public function subscribirse(Request $request, $id) {
        $voluntariado = Voluntariado::findOrFail($id);
        $user_id = [$request->user];
        $voluntariado->users()->attach($user_id);
        return $voluntariado->users;
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
