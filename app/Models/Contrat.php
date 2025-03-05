<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'locataire_id', 'bien_id', 'date_debut', 'date_fin',
        'montant_loyer', 'caution', 'parametrestatus_id', 'document', 'codecontrat'
    ];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
