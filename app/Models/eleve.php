<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule','nom','prenom','genre','tgp','dateNaissance','contactParent','fichier','ecole_id','classe','serie','mo'
    ];

    public function eleve_ecole() {
        return $this->belongsTo(ecole::class, 'ecole_id', 'id');
    }
}
