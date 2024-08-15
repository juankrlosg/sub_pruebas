<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sectors extends Model
{
    use HasFactory;
    protected $table = 'sector';
    protected $primaryKey='id_sector';
    protected $fillable=['description'];

}
