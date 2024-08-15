<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentToken extends Model
{
    use HasFactory;
    protected $table = 'payment_token';
    protected $primaryKey='id';
    protected $fillable=['token','date','amount','owner','id_status'];
}
