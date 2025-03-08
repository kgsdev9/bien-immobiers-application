<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    protected $fillable = [
        'codedossier',
        'locataire_id'

    ];


    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }
}
