<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interaccion extends Model
{
    use HasFactory;
    protected $table ="interaccions";
    protected $primaryKey ='id';
    public $timestamps = true;

    protected $filliable = [
        "id_perro_interesado",
        "id_perro_candidato",
        "preferencia"
    ];
    public function perro_interesado(){
        return $this->belongsTo(Perro::class,"id_perro_interesado");
    }
    public function perro_candidato(){
        return $this->belongsTo(Perro::class,"id_perro_candidato");
    }
}
