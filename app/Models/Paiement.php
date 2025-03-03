<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrat_id', 'mois_paye', 'montant', 'date_paiement',
        'mode_paiement', 'reference_paiement'
    ];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function quittance()
    {
        return $this->hasOne(Quittance::class);
    }
}
