<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    use HasFactory;
    protected $table = 'sites';
    protected $primaryKey='id_site';
    protected $fillable=['descripcion','sobrenombre','estatus'];
}
