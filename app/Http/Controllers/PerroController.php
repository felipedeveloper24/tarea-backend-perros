<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerroRequest;
use App\Models\Perro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PerroController extends Controller
{
    public function ShowAll(){
        return response()->json([
            "perros" => Perro::all()
        ],Response::HTTP_OK);
    }
    public function store(PerroRequest $request){
        $perro = new Perro();
        $perro->nombre = $request->nombre;
        $perro->url_foto = $request->url_foto;
        $perro->descripcion = $request->descripcion;
        $registro = $perro->save();
        
        if($registro){
            return response()->json("Perro creado exitosamente",Response::HTTP_OK);
        }else{
            return response()->json("Error al crear un perro",Response::HTTP_NOT_FOUND);
        }
    }
    public function update(Request $request){
        try{
            $request->validate([
                "id"=>"required|integer",
                "nombre" => "unique:perros"
            ]);
            $perro = Perro::findorFail($request->id); 
            isset($request->nombre) && $perro->nombre = $request->nombre;
            isset($request->url_imagen) && $perro->url_imagen = $request->url_imagen;
            isset($request->descripcion) && $perro->descripcion = $request->descripcion;
            $perro->save();
            return response()->json([
                "mensaje"=>"Perro actualizado correctamente",
                "perro" => $perro
            ]);
        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function delete(Request $request){
        try {
            $request->validate([
                "id"=>"required|integer"
            ]);
             Perro::find($request->id)->delete();

            return response()->json(["Perro eliminado exitosamente"], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}
