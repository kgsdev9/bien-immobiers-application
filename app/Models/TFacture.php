<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFacture extends Model
{
    use HasFactory;

    protected $table = "t_factures";

    protected $fillable = [
        'codefacture',
        'remise',
        'numcommande',
        'numvente',
        'libelleclient',
        'telephone',
        'email',
        'adresse_geo',
        'fax',
        'nom',
        'tvafacture',
        'prenom',
        'codeclient',
        'adresse',
        'date_echance',
        'mode_reglement_id',
        'status',
        'client_id',
        'codedevise_id',
        'user_id',
        'montanttva',
        'dateecheance',
        'montantadsci',
        'idregimevente',
        'idconditionvte',
        'montantht',
        'numcpteclient',
        'numcptecontribuable',
        'montantttc',
    ];


    public function items()
    {
        return $this->hasMany(TfactureLigne::class, 'numvente', 'numvente');
    }

    public function modereglement()
    {
        return $this->belongsTo(modereglement::class, 'mode_reglement_id');
    }
}
