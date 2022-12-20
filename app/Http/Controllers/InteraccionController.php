<?php

namespace App\Http\Controllers;
use App\Http\Requests\InteraccionRequest;
use App\Http\Requests\ShowInterracionRequest;
use App\Models\interaccion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InteraccionController extends Controller
{
    public function store(InteraccionRequest $request){
        //Antes de ingresar una interaccion tenemos que verificar si ya existe una interaccion para entre los perros
        $filas = interaccion::where('id_perro_interesado',$request->id_perro_interesado)
        -> where("id_perro_candidato",$request->id_perro_candidato) -> get();
        if($filas->count() !=0){
            return response()->json([
                "mensaje"=> "Se encontraron filas existentes ".$filas->count()
             ],Response::HTTP_BAD_REQUEST);
        }else{
              //Validamos que el id del perro candidato sea distinto al interesado
            if($request -> id_perro_interesado != $request -> id_perro_candidato){
                $interaccion = new interaccion();
                $interaccion->id_perro_interesado = $request -> id_perro_interesado;
                $interaccion->id_perro_candidato = $request -> id_perro_candidato;
                $interaccion->preferencia = $request->preferencia;
                $resultado = $interaccion->save();
                if($resultado){
                    return response()->json([
                        "mensaje"=>"Interacción creada correctamente",
                        "interaccion"=>$interaccion
                    ],Response::HTTP_OK);
                }
                    return response()->json([
                        "mensaje" => "Error al crear la interacción"
                    ],Response::HTTP_NOT_FOUND);

            }
            return response()->json([
                "mensaje"=> "El id del perro interesado debe ser distinto al candidato"
            ],Response::HTTP_BAD_REQUEST);
        }
    }
    public function showInteraccion(ShowInterracionRequest $request){
        $interacciones = interaccion::where('id_perro_interesado',$request-> id_perro_interesado)->get();
        if($interacciones->count()==0){
            return response()->json([
                "Mensaje" => "No hay interacciones registradas"
            ]);
        }

        return response()->json([
            "mensaje"=> "Se han encontrado registros",
            "data" => $interacciones
        ],response::HTTP_OK);

    }
}
