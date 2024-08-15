<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioUsuario extends Model
{
    use HasFactory;
    protected $table = 'servicio_usuario';
    protected $primaryKey='id_servicio_usuario';
    protected $fillable=['id_servicio','id_usuario','fecha','coordenada','id_router','señal','ip','id_sector','id_estatus'];
}
