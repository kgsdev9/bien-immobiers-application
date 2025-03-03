<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_locataire', 'nom', 'prenom', 'telephone',
        'email', 'adresse', 'profession', 'piece_identite'
    ];

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
}
