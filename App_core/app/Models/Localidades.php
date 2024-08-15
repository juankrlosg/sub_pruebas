<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidades extends Model
{
    use HasFactory;
    protected $table = 'localidades';
    protected $primaryKey='id';
        protected $fillable=['municipio_id','clave','nombre','activo'];
}
