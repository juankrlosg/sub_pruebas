<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoServicioUsuario extends Model
{
    use HasFactory;
    protected $table = 'pago_servicio_usuario';
    protected $primaryKey='id_pago_servicio_usuario';
    protected $fillable=['id_servicio_usuario','fecha','evidencia'];
}
