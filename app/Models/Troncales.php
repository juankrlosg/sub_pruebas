<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Troncales extends Model
{
    use HasFactory;
    protected $table = 'troncales';
    protected $primaryKey='id_troncal';
    protected $fillable=['id_site_o','id_site_d','ip_o','ip_d'];
}
