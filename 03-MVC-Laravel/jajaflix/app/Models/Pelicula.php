<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
        'duracion',
        'anio',
        'sinopsis',
        'imagen',
        'actorPrincipalID'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'id', 'id');
    }

}
