<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    use HasFactory;
    protected $table = 'persona';
    protected $primaryKey='id_persona';
    protected $fillable=['nombre','ap','am'];
}
