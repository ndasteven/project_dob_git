<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $primaryKey = 'matricule';
    public $incrementing = false;
    protected $fillable = [
        'matricule','nom','prenom','genre','tgp','dateNaissance','contactParent','fichier','CODE_ETABLISSEMENT'
    ];

}
