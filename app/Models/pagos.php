<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'cant',
        'valor',
        'domiciliario_id'
    ];

    public function domiciliario()
    {
        return $this->belongsTo('App\Models\User', 'domiciliario_id');
    }

    public function domicilios()
    {
        return $this->hasMany('App\Models\Domicilio', 'pago_id');
    }

}
