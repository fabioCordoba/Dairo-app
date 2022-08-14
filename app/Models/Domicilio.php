<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'admin_id',
        'domiciliario_id',
        'estado',
    ];

    public function admin()
    {
        return $this->belongsTo('App\Models\User', 'admin_id');
    }

    public function domiciliario()
    {
        return $this->belongsTo('App\Models\User', 'domiciliario_id');
    }
}
