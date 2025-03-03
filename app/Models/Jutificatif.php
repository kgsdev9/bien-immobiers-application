<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jutificatif extends Model
{
    use HasFactory;

    protected $fillable = [
        'locataire_id','name'
    ];
}
