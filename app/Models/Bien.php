<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'superficie',
        'nombre_pieces',
        'type_bien_id',
        'commune_id',
        'parametre_status_id'
    ];

    public function typeBien()
    {
        return $this->belongsTo(TypeBien::class, 'type_bien_id');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function status()
    {
        return $this->belongsTo(ParametreStatusBien::class, 'parametre_status_id');
    }


    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
}
