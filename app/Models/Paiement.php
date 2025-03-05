<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrat_id', 'mois_id', 'montant', 'date_paiement',
        'modereglement_id', 'reference_paiement'
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
