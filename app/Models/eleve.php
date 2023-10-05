<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule','nom','prenom','genre','tgp','dateNaissance','contactParent','ecole_id','classe','serie','mo','ecole_A'
    ];

    public function eleve_ecole_O() {
        return $this->belongsTo(ecole::class, 'ecole_id', 'id');
    }
    public function eleve_ecole_A() {
        return $this->belongsTo(ecole::class, 'ecole_A', 'id');
    }
}
