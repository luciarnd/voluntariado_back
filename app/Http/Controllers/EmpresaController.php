<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Voluntariado;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

public function index(Request $request) {
    return Empresa::all();
}

public function store(Request $request) {
    $this->validate($request, [
        'nombre' => 'required',
        'descripcion' => 'required',
    ]);

    $input = $request->all();

    $empresa = new Empresa($input);
    $empresa->save();
    return $empresa;
}

public function show(Request $request, $id) {
    return Empresa::findOrFail($id);
}

public function update(Request $request, $id) {
    $empresa = Empresa::findOrFail($id);
    $empresa->update($request->all());
    return $empresa;
}

    public function delete(Request $request, $id) {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return $empresa;
    }
}
