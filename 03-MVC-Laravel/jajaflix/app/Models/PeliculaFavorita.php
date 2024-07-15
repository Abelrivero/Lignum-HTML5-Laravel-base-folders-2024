<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaFavorita extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'peliculaId',
        'usuarioId'
    ];
    
    public function peliculasFavoritas(){
        return $this->belongsTo(Pelicula::class, 'peliculaId', 'id');
    }
}
