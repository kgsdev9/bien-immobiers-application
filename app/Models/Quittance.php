<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quittance extends Model
{
    use HasFactory;

    protected $fillable = ['paiement_id', 'date_emission', 'document', 'referencepaiement'];

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }
}
